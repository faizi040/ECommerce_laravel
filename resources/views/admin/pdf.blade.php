<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center mt-5">Order_Details</h1>
    Customer Name:<h3 class=" my-3">{{$order->name}}</h3>
    Customer E-mail:<h3 class=" my-3">{{$order->email}}</h3>
    Customer Address:<h3 class=" my-3">{{$order->address}}</h3>
    Customer Phone:<h3 class=" my-3">{{$order->phone}}</h3>
    Customer ID:<h3 class=" my-3">{{$order->user_id}}</h3>
    Product Name:<h3 class=" my-3">{{$order->product_title}}</h3>
    Product Quantity:<h3 class=" my-3">{{$order->quantity}}</h3>
    Product Price: <h3 class=" my-3">{{$order->price}}</h3>
    Product ID:<h3 class=" my-3">{{$order->product_id}}</h3>
    Payment Status:<h3 class=" my-3">{{$order->payment_status}}</h3>

 {{-- <img src="/Product-images/{{ $order->image }}" alt="" > --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>