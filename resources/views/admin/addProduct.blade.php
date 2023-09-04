<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.css')

    <style>
        .mySelect {
            background-color: #2A3038 !important;
            border: none;
            border-radius: 0px;
            outline: none !important;


        }

        .mySelect:focus {
            border: 1px solid green !important;
            box-shadow: none;
        }
    </style>
</head>

<body>

    {{-- modal code ended --}}

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.components.sidebar')
        <!-- partial -->
        @include('admin.components.navbar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container my-5">
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
                    <h1 class="text-center">Add Product</h1>
                    {{-- Form using html-laravl builder form --}}
                    {{ html()->form('post', '/add_product')->class('mt-5 ')->acceptsFiles()->open() }}

                    <div class="mb-3">
                        {{ html()->label('Product Title')->class('text-white ') }}
                        {{ html()->text('title')->class('form-control text-white')->placeholder('Enter Product Title') }}
                        <span class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Product Description')->class('text-white') }}
                        {{ html()->text('description')->class('form-control text-white')->placeholder('Enter Description') }}
                        <span class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Quantity')->class('text-white ') }}
                        {{ html()->number('quantity')->class('form-control text-white')->placeholder('Select Quantity minimum 1') }}
                        <span class="text-danger">
                            @error('quantity')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Price')->class('text-white ') }}
                        {{ html()->number('price')->class('form-control text-white')->placeholder('Enter Price') }}
                        <span class="text-danger">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Discount Price')->class('text-white') }}
                        {{ html()->number('discount_price')->class('form-control text-white')->placeholder('Enter discount if applied') }}

                    </div>
                    <div class=" mb-3"> {{-- Select form field --}}
                        {{ html()->label('Category')->class('text-white') }}
                        {{ html()->select('category', \App\Services\CategoryData::categoryForSelect())->class('form-select text-white mySelect') }}
                        {{-- fetchind data using custom service ----very important --}}

                        <span class="text-danger">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Product Image')->class('text-white') }}
                        {{ html()->file('image')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{ html()->submit('Add Product')->class('btn btn-secondary')->value('submit') }}
                    {{ html()->form()->close() }}


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
