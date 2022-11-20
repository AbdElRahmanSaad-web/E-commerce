<base href="/public">
@extends('admin_layout.app')

@section('body')

    <h1 class="mb-5">Update Product Page:</h1>

    <form class="w-50 offset-3" action="{{ route('update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Product Title: </label>
            <input type="text" class="form-control" value="{{ $product->title }}" name="title">
        </div>

        <div class="mb-3">
            <label>Product Description: </label>
            <input class="form-control" type="text" value="{{ $product->description }}" name="description">
        </div>

        <div class="mb-3">
            <img src="product/{{ $product->image }}" width="150px" alt="">
            <label>Product Image: </label>
            <input type="file" id='pro_img' value="{{ $product->image }}" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <label>Product Catagory: </label>
            <select name="catagory" class="form-control">
            <option value="{{ $product->catagory_id }}">{{ $product->Catagory->catagory_name }}</option>
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->catagory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product Price: </label>
            <input type="text" class="form-control" value="{{ $product->price }}" name="price">
        </div>

        <div class="mb-3">
            <label>Product Discount Price: </label>
            <input type="text" class="form-control" value="{{ $product->discount_price }}" name="discount">
        </div>

        <div class="mb-3">
            <label>Product Quantity: </label>
            <input type="text" class="form-control" value="{{ $product->quantity }}" name="quantity">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
