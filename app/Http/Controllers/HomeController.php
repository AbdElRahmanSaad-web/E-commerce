<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Stripe;

class HomeController extends Controller
{
    // function for home page for user
    public function index()
    {
        $products = Product::all();
        return view('home.userpage', compact('products'));
    }


    // function for multiAuth for user and admin
    public function redirect()
    {
        if (Auth::user()->usertype)
            return view('admin_layout.app');
        else {
            $products = Product::all();
            return view('home.userpage', compact('products'));
        }
    }
    public function productDetails($id)
    {
        $product = Product::find($id);
        return view('home.pro_details', compact('product'));
    }

    public function productPage()
    {
        $products = Product::all();
        return view('home.products_page', compact('products'));
    }


    public function addCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->quantity < $product->quantity) {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'quantity' => $request->quantity,
                'price' => $request->quantity * ($product->price - $product->discount_price),
            ]);
        } else
            return redirect()->back()->with('message', 'The Quantity is not enough');
        return redirect()->back()->with('message', 'The Product is added in Your Cart');
    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('home.cart', compact('cart'));
    }

    public function updateCart(Request $request, $id)
    {
        if ($request->quantity < Cart::find($id)->Product->quantity) {
            $pro = Cart::find($id);
            $pro->quantity = $request->quantity;
            $pro->price = $request->quantity * ($pro->Product->price - $pro->Product->discount_price);
            $pro->save();
        }
        return redirect()->back();
    }

    public function deleteCart($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function payCash(){
        $cart = Cart::where('user_id', Auth::user()->id)-> get();
        foreach($cart as $c){
            $order = new Order();
            $order -> user_id           = $c ->user_id;
            $order -> user_name         = Auth::user()->name;
            $order -> product_id        = $c ->product_id;
            $order -> quantity          = $c ->quantity;
            $order -> price             = $c ->price;
            $order -> payment_status    = 'cash';
            $order -> delivery_status   = 'processing';
            $order->save();

            // $product = Product::where('id' , $c ->product_id);
            // $product->quantity -= $c->quantity;
            // $product->save();
        }
        $cart_del = Cart::where('user_id', Auth::user()->id);
        $cart_del->delete();
        return redirect()->back()->with('message', 'Your Order has been received, you will be contacted soon');
    }

    public function stripe($totalprice){
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment"
        ]);
        Session::flash('success', 'Payment successful!');
        $cart = Cart::where('user_id', Auth::user()->id)-> get();
        foreach($cart as $c){
            $order = new Order();
            $order -> user_id           = $c ->user_id;
            $order -> user_name         = Auth::user()->name;
            $order -> product_id        = $c ->product_id;
            $order -> quantity          = $c ->quantity;
            $order -> price             = $c ->price;
            $order -> payment_status    = 'card';
            $order -> delivery_status   = 'processing';
            $order->save();
        }
        $cart_del = Cart::where('user_id', Auth::user()->id)->delete();
        return back();
    }

}
