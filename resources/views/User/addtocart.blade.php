<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to Cart</title>
    <style>

    </style>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            @include('User.header')
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Your Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0" style="float: left;">Cart - {{ $pro_data->count() }} items</h5>
                            <a href="/displayporduct/0" class="btn"
                                style="float: right;color:blue;text-decoration: underline;font-size: 14px;"><- Back to
                                    Shop Page</a>
                        </div>
                        <div class="card-body">
                            <!-- Single item -->
                            @if ($pro_data->count() > 0)
                                @foreach ($pro_data as $products)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                                data-mdb-ripple-color="light">
                                                <img src="{{ asset($products->product_image) }}" class="w-100"
                                                    alt="Blue Jeans Jacket" />
                                                <a href="#!">
                                                    <div class="mask"
                                                        style="background-color: rgba(251, 251, 251, 0.2)">
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- Image -->
                                        </div>

                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                            <!-- Data -->
                                            <p><strong>{{ $products->product_name }}</strong></p>
                                            <p>Color: {{ $products->product_color }}</p>
                                            <p>{{$products->product_measurement}}: {{ $products->product_measurement_value }}</p>
                                            <p data-id="{{ $products->product_price }}" id="product-price">Price: ₹ {{ $products->product_price }}</p>
                                            <button type="button"
                                                class="btn btn-danger btn-sm me-1 mb-2 deleteproductfromcartbtn"
                                                data-mdb-toggle="tooltip" title="Remove item"
                                                id="deleteproductfromcartbtn" value="{{ $products->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- Data -->
                                        </div>

                                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                            <!-- Quantity -->
                                            <div class="d-flex mb-4" style="max-width: 300px">
                                                <button class="btn btn-primary px-3 me-2 qty-minus"
                                                    style="height: 40px;"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <div class="form-outline" style="margin:0px 10px;">
                                                    <input id="form1" min="1" name="quantity"
                                                        value="{{ $products->product_quantity }}" type="number"
                                                        class="form-control product_qty" />
                                                    <label class="form-label" for="form1">Quantity</label>
                                                </div>

                                                <button class="btn btn-primary px-3 ms-2 qty-plus" style="height: 40px;"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- Quantity -->


                                            <!-- Price -->
                                            <div style="margin-top: 100px;">
                                                <b>
                                                    <p class="text-start text-md-center totalprice"
                                                        style="margin-top: 5%;" id="product_price"
                                                        name="product_price[]" value="{{ $products->product_price }}"
                                                        data-product-id="{{ $products->id }}"
                                                        data-product-category="{{ $products->category_id }}"
                                                        data-product-price="{{ $products->product_price * $products->product_quantity }}">
                                                        Final Price : ₹
                                                        {{ $products->product_price * $products->product_quantity }}
                                                    </p>
                                                </b>
                                            </div>
                                            <!-- Price -->
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                @endforeach
                            @else
                                <h5 class="mb-0">No items</h5>
                            @endif
                            <!-- Single item -->

                        </div>
                    </div>
                    @if ($pro_data->count() > 0)
                        <div class="card mb-4">
                            <div class="card-body">
                                <p><strong>Expected shipping delivery</strong></p>

                                <p class="mb-0 expected_delivery"></p>
                            </div>
                        </div>
                    @endif
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body">
                            <p><strong>Payment : Cash on delivery</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($pro_data as $products)
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        {{ $products->product_name }}
                                        <span>
                                            <p id="p_id_{{ $products->id }}">
                                                ₹ {{ $products->product_price * $products->product_quantity }}
                                            <p>
                                        </span>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>Free Delivery</span>
                                </li>

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>

                                    </div>
                                    <span><strong>
                                            <p class="product_total_price"></p>
                                        </strong></span>
                                </li>
                            </ul>

                            <a href="/checkout" type="button" class="btn btn-primary btn-lg btn-block">
                                Go to checkout
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script> --}}

    <script>
        $(document).ready(function() {

            console.log({!! json_encode($pro_data) !!});

            var pro_price = $("#product-price").data("id");
            console.log(parseInt(pro_price));

            var final_total_price = 0;
            var discount_rate = 0;
            var discount_apply_on_category = "";

            var currentDate = new Date();
            var delivery_date = currentDate.setDate(currentDate.getDate() + 5);
            var expected_delivery = currentDate.getDate() + "-" + (currentDate.getMonth() + 1) + "-" +
                currentDate.getFullYear();
            $('.expected_delivery').html(expected_delivery);
            total();


            $(document).on('click', '.qty-plus', function() {
                var value = parseInt($(this).parent().find('.product_qty').val());
                // var p_price = $(this).parent().parent().find('#product_price').attr('value');
                p_price = $(this).parent().parent().parent().find('#product-price').data("id");
                var finalprice = p_price * value;
                var product_id = $(this).parent().parent().find('#product_price').attr('data-product-id');
                $("#p_id_" + product_id).html("₹ " + finalprice);
                console.log(finalprice + " " + product_id + " " + value);
                updatepriceondatabase(product_id, value);
                $(this).parent().parent().find('#product_price').html("Final Price : ₹ " + finalprice);
                $(this).parent().parent().find('#product_price').attr('data-product-price', p_price *
                    value);
                $(this).parent().find('.product_qty').attr('value', value++);
                total();
                // applydiscount();
            });

            $(document).on('click', '.qty-minus', function() {
                var value = parseInt($(this).parent().find('.product_qty').val());
                // var p_price = $(this).parent().parent().find('#product-price').attr('value');
                p_price = $(this).parent().parent().parent().find('#product-price').data("id");
                var finalprice = p_price * value;
                var product_id = $(this).parent().parent().find('#product_price').attr('data-product-id');
                $("#p_id_" + product_id).html("₹ " + finalprice);
                console.log(finalprice + " " + product_id + " " + value);
                updatepriceondatabase(product_id, value);
                $(this).parent().parent().find('#product_price').html("Final Price : ₹ " + finalprice);
                $(this).parent().parent().find('#product_price').attr('data-product-price', finalprice);
                $(this).parent().find('.product_qty').attr('value', value--);
                total();
                // applydiscount();
            });

            function updatepriceondatabase(product_id, quantity) {

                $.ajax({
                    url: '/updateprice',
                    type: 'POST',
                    data: {
                        productid: product_id,
                        product_quantity: quantity,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        window.location.href = '/error/' + error.status + '/' + encodeURIComponent(error
                            .statusText);
                    }
                });
            }

            function total() {
                final_total_price = 0;
                var productPrices = $('.totalprice').map(function() {
                    return parseInt($(this).attr('data-product-price'));;
                }).get();

                productPrices.forEach(element => {
                    final_total_price += element;
                });

                $('.product_total_price').html("₹ " + final_total_price);

            }

            function totalfromcategory(category_id) {
                var productPrices = $('.totalprice').map(function() {
                    if ($(this).attr('data-product-category') == category_id) {
                        updatepriceondatabase()
                        return parseInt($(this).attr('data-product-price'));
                    }
                }).get();

                var price = 0;
                productPrices.forEach(element => {
                    price += element;
                });

                return price;
            }

            $(document).on('click', '.deleteproductfromcartbtn', function() {
                var product__cart_id = $(this).val();
                $.ajax({
                    url: '/deleteproductfromcart',
                    type: 'POST',
                    data: "id=" + product__cart_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                });
            });


            $("#discount_coupon").on("input", function() {
                $("#discount_code_error_msg").html(" ");
            });




            // function applydiscount() {
            //     var t_price = totalfromcategory(discount_apply_on_category);
            //     var discount_price = (parseInt(t_price) * discount_rate) / 100;

            //     if (t_price > 0) {
            //         setTimeout(() => {
            //             $("#discount_code_error_msg").css("display",
            //                 "none");
            //         }, 5000);

            //     }

            //     $(".discountprice").html("₹  " + discount_price);
            //     $(".product_total_price").html("₹  " + (final_total_price -
            //         discount_price));

            //     console.log(final_total_price - discount_price);
            // }


        });
    </script>

</body>

</html>
