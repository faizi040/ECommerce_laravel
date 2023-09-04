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

        @endif
            <h1 class="my-5 text-center">List of Products</h1>
            <table class="table table-hover table-striped table-bordered  ">
                <thead>
                    <tr>

                        <th scope="col">Product Title</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php $totalPrice =0; ?>
                    @foreach ($carts as $cart)
                        <tr>
                            <td scope="row">{{$cart->product_title}}</td>
                            <td scope="row">{{$cart->quantity}}</td>
                            <td scope="row">${{$cart->price}}</td>
                            <td scope="row"><img src="/Product-images/{{ $cart->image }}"
                            alt="" style="height: 100px; width:100px;"></td>
                            <td>
                                <a href="{{url('/remove_cart')}}/{{$cart->id}}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to remove this ?')">Remove</a>
                            </td>
                            <?php $totalPrice =$totalPrice + $cart->price ;
                            
                            ?>

                        </tr>
                    @endforeach
                    



                </tbody>
            </table>
            <h1 class="text-center my-4">Total Price : ${{$totalPrice}}</h1>

        <div>
            <h1>Proceed to Order</h1>
            <a href="{{url('/cash_order')}}" class="btn btn-danger">Cash on Delivery</a>
            <a href="{{url('/stripe',$totalPrice)}}" class="btn btn-danger">Pay Using Card</a>
        </div>
        </div>
       
    </div>




    {{-- footer section --}}
    @include('user.components.footer')
    {{-- footer section ends --}}
</body>

</html>
