<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.css')
</head>

<body>

    {{-- modal code started --}}
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::get('Fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Fail') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <h1 class="text-center">Add Category</h1>
                    {{-- Form using html-laravl builder form --}}
                    {{ html()->form('post', '/add_category')->class('mt-5 ')->open() }}
                    <div class="mb-3">
                        {{ html()->label('Category Name')->class('text-white') }}
                        {{ html()->text('name')->class('form-control text-white')->placeholder('Enter Category Name') }}
                        <span class="text-danger">
                            @error('name')
                            {{$message}}
                                
                            @enderror
                        </span>

                    </div>

                    {{ html()->submit('Add Category')->class('btn btn-secondary')->value('submit') }}
                    {{ html()->form()->close() }}

                    <div class="table-responsive-md my-5 text-center ">
                        <h1 class="my-5 text-center text-white">List of Categories</h1>
                        <table class="table table-hover table-striped my-5">
                            <thead>
                                <tr>
                                    <th scope="col">Sr No.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            {{-- <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</a> --}}

                                            <a href="{{ url('/delete_category') }}/{{ $category->id }}"
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
