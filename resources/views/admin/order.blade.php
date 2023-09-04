<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.css')
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.components.sidebar')
        <!-- partial -->
        @include('admin.components.navbar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::get('Fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Fail') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive-md overflow-x-scroll text-center ">
                        <h1 class="my-5 text-center text-white">List of orders</h1>

                        <div>
                            {{ html()->form('get', '/search')->class('mt-5 ')->open() }}
                            <div class="row">


                                <div class="mb-3 col-md-6">

                                    {{ html()->text('search')->class('form-control text-white')->placeholder('Serach by name,phone or product title') }}
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>

                                <div class="col-md-6 d-flex justify-content-start mb-3">

                                    {{ html()->submit('Search')->class('btn btn-outline-primary ')->value('submit') }}
                                </div>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                        <table class="table table-hover table-striped  ">
                            <thead>
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Delivered</th>
                                    <th scope="col">Download PDF</th>
                                    <th scope="col">Send E-mail</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td scope="row">{{ $order->name }}</td>
                                        <td scope="row">{{ $order->email }}</td>
                                        <td scope="row">{{ $order->phone }}</td>
                                        <td scope="row">{{ $order->address }}</td>
                                        <td scope="row">{{ $order->product_title }}</td>
                                        <td scope="row">{{ $order->quantity }}</td>
                                        <td scope="row">{{ $order->price }}</td>
                                        <td scope="row">{{ $order->payment_status }}</td>
                                        <td scope="row">{{ $order->delivery_status }}</td>
                                        <td scope="row"><img src="/Product-images/{{ $order->image }}"
                                                alt="" style="height: 50px; width:50px;"></td>

                                        <td>
                                            @if ($order->delivery_status != 'delivered')
                                                <a href="{{ url('/devilered', $order->id) }}" class="btn btn-primary"
                                                    onclick="return confirm('Are you sure that this product is delieved ?')">Delivered</a>
                                            @else
                                                <p class="text-success">Delivered</p>
                                            @endif
                                        </td>
                                        <td><a href="{{ url('/download_pdf', $order->id) }}"
                                                class="btn btn-info">Download PDF</a></td>

                                        <td><a href="{{ url('/send_email', $order->id) }}" class="btn btn-primary">Send
                                                E-mail</a></td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    @include('admin.components.js')
</body>

</html>
