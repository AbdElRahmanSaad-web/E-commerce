<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <style>
        .payment{
            font-size: 25px
        }
        .empty{
            height: 100px;
            background-color: #eee;
            color: black;
        }
        .old {
            text-decoration: line-through;
        }

        #update-form {
            display: none;
        }
    </style>
    @include('inc.css_meta')
</head>

<body>
    @include('inc.header')
    <div class=" container text-center">
        @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            @php($total = 0)
            @foreach ($cart as $product)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="product/{{ $product->Product->image }}" class="img-fluid rounded-start"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Product Name: {{ $product->Product->title }}</h5>
                                <p class="card-text">Product Quantity: {{ $product->quantity }}</p>
                                <h4 class="card-text">Product Price: {{ $product->price }}</h4>
                                @php($total += $product->price)
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update.cart', $product->id) }}" class="d-flex" id="update-form" method="post">
                                    @csrf
                                    @method('put')
                                    <input class="form-item" type="number" name='quantity'>
                                    <button class="btn btn-success form-item">Update</button>
                                </form>
                                <a onclick='show()' class="btn btn-warning">update Quantity</a>
                                <form class="inline" action="{{ route('delete.cart', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                <h1 class="my-5">Total Price= {{ $total }} $</h1>
            </div>
            
            <div class="col-12 mb-5">
                <h1 class="mt-5 mb-2 payment">Proceed Payment</h1>
                <a class="btn btn-danger" href="{{ route('pay.cash') }}">Cash On Delivery</a>
                <a class="btn btn-danger" href="{{ route('stripe', $total) }}">Pay Using Card</a>
            </div>
        </div>
    </div>
    @include('inc.footer')
</body>

</html>
