<!DOCTYPE html>
<html lang="en">

<head>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

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
        <!-- start slider section -->
        @include('user.components.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('user.components.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('user.components.arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('user.components.product')
    <!-- end product section -->

    {{-- Comment section starts here --}}

    <div class="container my-5">
        <h1 class="text-center fw-bold my-4">
            Comment Section
        </h1>

        {{ html()->form('post', '/add_comment')->class('mt-5 ')->open() }}
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show offset-3 col-6" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <div class="mb-3 col-6">
                {{ html()->label('Enter Comment')->class('fw-bold m-2') }}
                {{ html()->textarea('comment')->class('form-control ')->placeholder('Enter Your Comment')->rows(8)->required() }}


            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ html()->submit('Comment')->class('text-white btn btn-info fw-bold')->value('submit') }}

        </div>

        {{ html()->form()->close() }}

        <div class="d-flex justify-content-center">
            <div class="col-6">
                <h2 class="fw-bold mb-4 mt-4">
                    All Comments
                </h2>
                @foreach ($comments as $comment)
                    <div>
                        <span class="fw-bold mt-3 d-block" style="font-size: 18px;">{{ $comment->name }}</span>
                        <p>{{ $comment->comment }}</p>
                        <a href="javascript::void(0);" onclick="reply(this)"
                            data-commentId="{{ $comment->id }}">Reply</a>
                        @foreach ($replies as $reply)
                            @if ($reply->comment_id == $comment->id)
                                <div class="ms-5 mt-2">
                                    <span class="fw-bold mt-2 d-block"
                                        style="font-size: 18px;">{{ $reply->name }}</span>
                                    <p>{{ $reply->reply }}</p>
                                </div>
                            @endif
                        @endforeach



                    </div>
                @endforeach
                <div class="replyDiv" style="display: none;">


                    {{ html()->form('post', '/add_reply')->class('my-3 ')->open() }}
                    <div class="">
                        <div class=" col-8">

                            {{ html()->hidden('commentId')->id('commentId') }}

                            {{ html()->textarea('reply')->class('form-control ')->placeholder('Enter Reply')->rows(3)->required() }}


                        </div>
                    </div>

                    {{ html()->submit('Reply')->class('text-white btn btn-info fw-bold')->value('submit') }}
                    <a href="javascript::void(0);" class="btn btn-danger" onclick="reply_close(this)">Close</a>



                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>




    {{-- Comment section ends here --}}

    <!-- subscribe section -->
    @include('user.components.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('user.components.client')
    <!-- end client section -->
    {{-- footer section --}}
    @include('user.components.footer')
    {{-- footer section ends --}}

    <script>
        function reply(caller) {

            //getting id of comment and storing it into replies table
            document.getElementById('commentId').value = $(caller).attr('data-commentId')
            //code to put reply form after every comment on which user click for reply
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }

        function reply_close(caller) {


            $('.replyDiv').hide();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
</body>

</html>
