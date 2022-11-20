@extends('admin_layout.app')

@section('body')
    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif --}}

    <h1>Show Orders Page</h1>
    <div class="text-center">
        <form action="{{ route('search') }}" method="get">
            @csrf
            <input type="text" name='search' placeholder="Enter User Name">
            <input type='submit' value="Search" class="btn btn-primary" />
        </form>
    </div>
    @php($n = 1)
    <table class="table table-dark table-striped mt-5">
        <thead>
            <th>#</th>
            <th>User Name</th>
            <th>User ID</th>
            <th>Product Title</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delivery Status</th>
            <th>payment Status</th>
            <th>Print PDF</th>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $order->user_name }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->Product->title }}</td>
                    <td>{{ $order->product_id }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td><a class="btn btn-primary" href="{{ route('print.pdf', $order->id) }}">Print PDf</a></td>
                    {{-- <td>
                        <a href="{{ route('update.page', $product->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        @if (Auth::user()->usertype == '1')
                        <form action="{{ route('delete.product', $product->id) }}" method="POST" class=" d-inline-block">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you Sure To Delete This')" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                        @endif
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
