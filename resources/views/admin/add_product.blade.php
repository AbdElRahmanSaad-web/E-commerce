@extends('admin_layout.app')

@section('body')

    <h1 class="mb-5">Add Product Page:</h1>

    <form class="w-50 offset-3" action="{{ route('create.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Product Title: </label>
            <input type="text" class="form-control" placeholder="Enter Product Title" name="title">
        </div>

        <div class="mb-3">
            <label>Product Description: </label>
            <input class="form-control" type="text" placeholder="Enter Product Description" name="description">
        </div>

        <div class="mb-3">
            <label>Product Image: </label>
            <input type="file" id='pro_img' class="form-control" placeholder="Enter Product Image" name="image">
        </div>

        <div class="mb-3">
            <label>Product Catagory: </label>
            <select name="catagory" class="form-control">
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->catagory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product Price: </label>
            <input type="text" class="form-control" placeholder="Enter Product Price" name="price">
        </div>

        <div class="mb-3">
            <label>Product Discount Price: </label>
            <input type="text" class="form-control" placeholder="Enter Product Discount Price" name="discount">
        </div>

        <div class="mb-3">
            <label>Product Quantity: </label>
            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="quantity">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
