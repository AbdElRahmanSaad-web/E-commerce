<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Order Detail</h1>
    Customer Name:               <h3>{{$order->User->name }}</h3>
    Customer E-Mail:             <h3>{{$order->User->email }}</h3>
    Customer Phone:              <h3>{{$order->User->phone }}</h3>
    Customer Address:            <h3>{{$order->User->address }}</h3><br /><hr />

    Product Title:               <h3>{{$order->Product->title }}</h3>
    Product Description:         <h3>{{$order->Product->description }}</h3>
    Product Quantity:            <h3>{{$order->quantity }}</h3>
    Product Price:               <h3>{{$order->price }}</h3>
    Product Payment Status:      <h3>{{$order->payment_status }}</h3><br /><hr />
</body>
</html>
