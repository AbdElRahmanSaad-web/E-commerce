<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <style>
        .old{
            text-decoration: line-through;
        }
    </style>
    @include('inc.css_meta')
</head>

<body>

    @include('inc.header')

    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="p-4 offset-4 col-sm-6 col-md-4 col-lg-4">
        <div class="box">
            <div class="img-box">
                <img width="500px" src="product/{{ $product->image }}" alt="">
            </div>
            <div class="detail-box mt-3">
                <h5>{{ $product->title }}</h5>
                <h6>{{ $product->description }}</h6>
                <h6>Catagory: {{ $product->Catagory->catagory_name }}</h6>
                <h6>Quantity: {{ $product->quantity }}</h6>
                @if($product->discount_price == '')
                    <h6 class="text-primary">Price: {{ $product->price }}</h6>
                @else
                <div class='d-flex justify-content-between align-items-center'>
                    <h6 class="text-primary old">Price: {{ $product->price }}</h6>
                    <h5 class="text-danger">Discount: {{ $product->discount_price }}</h5>
                </div>
                <h5 class="text-primary">New Price: {{ $product->price - $product->discount_price }}</h5>
                @endif
                <form action="{{ route('add.cart', $product->id) }}" method="POST" class="d-flex flex-row align-items-center'">
                    @csrf
                    <input class="w-50 m-4" type="number" name="quantity" start='0' value="1">
                    <button class="btn btn-success">Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
    @include('inc.footer')

</body>

</html>
