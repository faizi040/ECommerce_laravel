<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
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

                    <h1 class="text-center">Send E-mail to {{ $order->email }}</h1>
                    {{-- form for search --}}
                    {{-- form for search --}}

                   
                    {{-- form for search --}}
                    {{-- form for search --}}
                    {{ html()->form('post', "/send_user_email/$order->id")->class('mt-5 ')->open() }}

                    <div class="mb-3">
                        {{ html()->label('E-mail Greeting')->class('text-white ') }}
                        {{ html()->text('greeting')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('greeting')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('E-mail Firstline')->class('text-white') }}
                        {{ html()->text('firstline')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('firstline')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('E-mail Body')->class('text-white ') }}
                        {{ html()->text('body')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('body')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('E-mail Button Name')->class('text-white ') }}
                        {{ html()->text('button')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('button')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('E-mail Url')->class('text-white') }}
                        {{ html()->text('url')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('url')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        {{ html()->label('E-mail Last Line')->class('text-white') }}
                        {{ html()->text('lastline')->class('form-control text-white') }}
                        <span class="text-danger">
                            @error('lastline')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>



                    {{ html()->submit('Send E-mail')->class('btn btn-info')->value('submit') }}
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
