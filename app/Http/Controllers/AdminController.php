<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use PDF;
class AdminController extends Controller
{
    // functions related by catagory
    public function viewCatagory(){
        $catagories = Catagory::get();
        return view('admin.catagory', compact('catagories'));
    }

    public function addCatagory(Request $request){
        $cat = new Catagory;

        $cat->catagory_name = $request->catagory;
        $cat->save();
        return redirect()->back()->with('message', 'Catagory Added Successfully');
    }

    public function deleteCatagory($id){
        $cat = Catagory::find($id);
        $cat->delete();
        return redirect()->back()->with('message', 'Catagory Deleted Successfully');;
    }


    // functions related by products
    public function addProduct(){
        $cats = Catagory::all();
        return view('admin.add_product', compact('cats'));
    }
    public function createProduct(Request $request){
        $pro = new Product;

        $pro->title = $request->title;
        $pro->description = $request->description;
        $pro->price = $request->price;
        $pro->quantity = $request->quantity;
        $pro->catagory_id = $request->catagory;
        $pro->discount_price = $request->discount;

        $image = $request->image;
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $image_name);
        $pro->image = $image_name;

        $pro->save();
        return redirect()->route('view.product');
    }

    public function viewProduct(){
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function updatePage($id){
        $product = Product::find($id);
        $cats = Catagory::all();
        return view('admin.update_product', compact('product', 'cats'));
    }
    public function updateProduct(Request $request, $id){

        $pro = Product::find($id);
        $pro->title = $request->title;
        $pro->description = $request->description;
        $pro->price = $request->price;
        $pro->quantity = $request->quantity;
        $pro->catagory_id = $request->catagory;
        $pro->discount_price = $request->discount;

        $image = $request->image;
        if($image){
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $image_name);
            $pro->image = $image_name;
        }
        $pro->save();
        return redirect()->route('view.product');
    }
    public function deleteProduct($id){
        $pro = Product::find($id);
        $pro->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');;
    }
    // functions related by users
    public function viewUser(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function roleUser(){
        $persons = User::all();
        return view('admin.user_role', compact('persons'));
    }
    public function saveRole(Request $request, $id){
        $person = User::find($id);
        $person -> usertype = $request->role;
        $person->save();
        return redirect()->back();
    }

    // public function updateUser(Request $request, $id){
    //     User::find($id)->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'address' => $request->address,
    //         'usertype' => $request->user_role,
    //     ]);
    //     return redirect()->back();
    // }
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }


    public function viewOrder(){
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function printPDF($id){
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('Order_Details'.$id.'.pdf');
    }

    public function search(Request $request){
        $search = $request->search;
        // $user = User::where('name', 'LIKE', "%$search%")->get('id');
        // foreach($user as $u)
        //     $arr[] = $u->id;
        $orders = Order::where('user_name', 'LIKE', "%$search%")->get();
        return view('admin.orders', compact('orders'));
    }
}
