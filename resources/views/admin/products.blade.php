@extends('admin_layout.app')

@section('body')
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <h1>Show Products Page</h1>

    @php($n = 1)
    <table class="table table-dark table-striped mt-5">
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discount Price</th>
            <th>Quantity</th>
            <th>Catagory</th>
            <th>image</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->discount_price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->Catagory->catagory_name }}</td>
                    <td><img src="product/{{  $product->image }}"></td>
                    <td>
                        <a href="{{ route('update.page', $product->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        @if(Auth::user()->usertype == '1')
                        <form action="{{ route('delete.product', $product->id) }}" method="POST" class=" d-inline-block">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you Sure To Delete This')" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
