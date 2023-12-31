<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('/product_details') }}/{{ $product->id }}" class="option1">
                                    Product Details
                                </a>
                                {{ html()->form('post', "/add_cart/$product->id")->open() }}
                                <div class="row">
                                    <div class="col-sm-6">

                                        {{ html()->number('quantity')->value('1')->style('width:100px') }}

                                    </div>
                                    <div class="col-sm-6">

                                        {{ html()->submit('Add to Cart')->class('option2')->value('submit') }}
                                    </div>
                                </div>

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/Product-images/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            @if ($product->discount_price != 0)
                                <h6 style="color: blue;">
                                    Discount Price
                                    <br>
                                    ${{ $product->discount_price }}
                                </h6>
                                <h6 style="text-decoration: line-through; color:red;">
                                    Price
                                    <br>
                                    ${{ $product->price }}
                                </h6>
                            @else
                                <h6 style="color:blue;">
                                    Price
                                    <br>
                                    ${{ $product->price }}
                                </h6>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach





        </div>



        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}


        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>
</section>
