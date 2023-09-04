<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <base href="/public">
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
        <div class="container ">
            <div class="row py-5">
                <div class="col-md-6 col-sm-12 col-12 p-4">
                    <h1 class="text-center">{{ $product->title }}</h1>
                    <p class="h5 my-5"><span class="fw-bold">Description : </span>{{ $product->description }}</p>
                    @if ($product->discount_price != 0)
                        <div class="d-flex justify-content-between mt-3">
                            <h6 class="text-secondary">
                                Discount Price :

                                ${{ $product->discount_price }}
                            </h6>
                            <h6 style="text-decoration: line-through;">
                                Price :

                                ${{ $product->price }}
                            </h6>

                        </div>
                    @else
                        <h6 class="mt-3 text-secondary">
                            Price :

                            ${{ $product->price }}
                        </h6>
                    @endif
                    <h6 class=" mt-3 text-secondary">
                        Quantity Available :

                        {{ $product->quantity }}
                    </h6>
                    <h6 class="mt-3 text-secondary">

                        Product Category :

                        {{ $product->category }}
                    </h6>
                </div>
                <div class="col-md-6 col-sm-12 col-12 project-detail">
                    <div class="img">
                        <img src="Product-images/{{ $product->image }}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-4 cart-form">

                {{ html()->form('post', "/add_cart/$product->id")->open() }}
                <div class="row d-flex-justify-content-center">
                    <div class="col-md-6">

                        {{ html()->number('quantity')->value('1')->style('width:100px;') }}

                    </div>
                    <div class="col-md-6 ">

                        {{ html()->submit('Add to Cart')->class('option2')->value('submit') }}
                    </div>
                </div>

                {{ html()->form()->close() }}
            </div>


        </div>





        {{-- footer section --}}
        @include('user.components.footer')
        {{-- footer section ends --}}
</body>

</html>
