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
                        <h1 class="my-5 text-center text-white">List of Products</h1>
                        <table class="table table-hover table-striped  ">
                            <thead>
                                <tr>

                                    <th scope="col">Title</th>
                                    <th scope="col">description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount Price</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td scope="row">{{ $product->title }}</td>
                                        <td scope="row">{{ $product->description }}</td>
                                        <td scope="row"><img src="/Product-images/{{ $product->image }}"
                                                alt="" style="height: 50px; width:50px;"></td>
                                        <td scope="row">{{ $product->category }}</td>
                                        <td scope="row">{{ $product->quantity }}</td>
                                        <td scope="row">{{ $product->price }}</td>
                                        <td scope="row">{{ $product->discount_price }}</td>

                                        <td>
                                            <a href="{{url('/edit_product')}}/{{$product->id}}" class="btn btn-warning">Edit</a>

                                            <a href="{{ url('delete_product') }}/{{ $product->id }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete this ?')">Delete</a>
                                        </td>

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
