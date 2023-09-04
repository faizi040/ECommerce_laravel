<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="Assets/images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- font awesome style -->
    <link href="Assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="Assets/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="Assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('user.components.header')
        <!-- end header section -->


        <div class="container table-responsive-md  text-center my-5 ">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::get('Fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('Fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1 class="my-5 text-center">List of Ordered Products</h1>
            <table class="table table-hover table-striped table-bordered text-center ">
                <thead>
                    <tr>

                        <th scope="col">Product Title</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Image</th>
                        <th scope="col">Cancel Order</th>


                    </tr>
                </thead>

                <tbody>
                    <?php
                    // $totalPrice =0;
                    ?>
                    @foreach ($orders as $order)
                        <tr>
                            <td scope="row">{{ $order->product_title }}</td>
                            <td scope="row">{{ $order->quantity }}</td>
                            <td scope="row">${{ $order->price }}</td>
                            <td scope="row">{{ $order->payment_status }}</td>
                            <td scope="row">{{ $order->delivery_status }}</td>
                            <td scope="row"><img src="/Product-images/{{ $order->image }}" alt=""
                                    style="height: 100px; width:100px;"></td>
                            <td>
                                @if ($order->delivery_status == 'Processing')
                                    <a href="{{ url('/cancel_order') }}/{{ $order->id }}" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to cancel this ?')">Cancel Order</a>
                                @endif
                                @if ($order->delivery_status == 'Canceled')
                                    <p class="fw-bold text-danger">Canceled</p>
                                @endif
                                @if ($order->delivery_status == 'delivered')
                                    <p class="fw-bold text-success">Delivered</p>
                                @endif


                            </td>
                            <?php
                            // $totalPrice =$totalPrice + $cart->price ;
                            ?>

                        </tr>
                    @endforeach




                </tbody>
            </table>
            {{-- <h1 class="text-center my-4">Total Price : ${{$totalPrice}}</h1> --}}

            {{-- <div>
            <h1>Proceed to Order</h1>
            <a href="{{url('/cash_order')}}" class="btn btn-danger">Cash on Delivery</a>
            <a href="{{url('/stripe',$totalPrice)}}" class="btn btn-danger">Pay Using Card</a>
        </div> --}}
        </div>

    </div>




    {{-- footer section --}}
    @include('user.components.footer')
    {{-- footer section ends --}}
</body>

</html>
