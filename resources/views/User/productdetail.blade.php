<?php
$variantValue = explode(',', $variantData[0]->variant_value);
$variantColor = explode(',', $variantData[0]->colours);
$variantPrice = explode(',', $variantData[0]->prices);
$variantStock = explode(',', $variantData[0]->stocks);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Product Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <?php
        $product_images = explode(',', $pro_data->p_image_1);
        ?>
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active" style="height:300px;">
                            <img class="w-100 h-100" style="object-fit: contain;"
                                src="{{ asset('product_images/' . $product_images[0]) }}" alt="Image">
                        </div>
                        @for ($i = 1; $i < count($product_images) - 1; $i++)
                            <div class="carousel-item" style="height:300px;">
                                <img class="w-100 h-100" style="object-fit: contain;"
                                    src="{{ asset('product_images/' . $product_images[$i]) }}" alt="Image">
                            </div>
                        @endfor
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">

                <h3 class="font-weight-semi-bold">{{ $pro_data->name }}</h3>
                <div class="d-flex mb-3">
                    {{-- <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small> --}}
                </div>
                <h3 class="font-weight-semi-bold mb-4 product_price">₹ {{ $pro_data->price }}</h3>
                <p class="mb-4">{{ $pro_data->shortDescription }}</p>


                {{-- Product Measurement Variant Section --}}
                <div class="mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">{{ $variantData[0]->variant_name }}:</p>
                    @foreach ($variantValue as $key => $vValue)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input variantvalue"
                                id="{{ $variantData[0]->variant_name . $key }}"
                                name="{{ $variantData[0]->variant_name }}" value="{{ $vValue }}"
                                data-id="{{ $key }}">
                            <label class="custom-control-label"
                                for="{{ $variantData[0]->variant_name . $key }}">{{ $vValue }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Color Variant Section --}}
                <div class= "mb-4">
                    @if (count($variantColor) > 0)
                        <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                        @foreach ($variantColor as $key => $vColor)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input color" id="{{ $vColor . $key }}"
                                    name="color" value="{{ $vColor }}" data-id="{{ $key }}">
                                <label class="custom-control-label"
                                    for="{{ $vColor . $key }}">{{ $vColor }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if ($variantData[0]->sumstocks > 0)
                    <div class="d-flex align-items-center mb-4 pt-2 quantity" id="product_quantity">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center qty" value="1"
                                min="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addtocartbtn" class="btn btn-primary px-3">
                            <i class="fa fa-shopping-cart mr-2"></i>
                            Add To Cart
                        </button>
                        <button type="button" id="addtowishlistbtn" class="btn btn-primary px-3 ml-2">
                            <i class="fas fa-heart mr-2"></i>
                            Add To Wishlist
                        </button>
                    </div>
                @endif
                <div class="notifymessage">
                    <p style="display: none;" class="stockstatus alert alert-info"></p>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>

                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{ $pro_data->Description }}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->





    @include('User.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    {{-- <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script> --}}


    <script>
        $(document).ready(function() {
            var user_id = {!! json_encode(Session::get('user_id')) !!};

            var product = {!! json_encode($pro_data) !!}
            console.log(product);
            var i = 1;
            var product_stock = {!! json_encode($variantData[0]->sumstocks) !!};
            console.log(product_stock);

            var variantPrice = {!! json_encode($variantPrice) !!};

            if (product_stock <= 10) {
                $(".stockstatus").css("display", "block");
                if (product_stock < 1) {
                    $(".stockstatus").html("Out of Stock");
                } else {
                    $(".stockstatus").html("Only " + product_stock + " Stock is Available");
                }

            }

            $('.btn-plus').click(function() {
                // console.log($('.qty').val());
                if (i < product_stock) {
                    i++;
                    $('.qty').val(i);
                } else {
                    $(".stockstatus").css("display", "block");
                    $(".stockstatus").html("Only " + product_stock + " Stock is Available");
                }

            });

            $('.btn-minus').click(function() {
                console.log($('.qty').val());
                if (i !== 1) {
                    if (i <= product_stock) {
                        $(".stockstatus").css("display", "none");
                        i--;
                    }
                }
                $('.qty').val(i);
            });


            var category_name = {!! json_encode($cat_data->name) !!};

            $(document).on('click', '#addtowishlistbtn', function() {

                if ($(".variantvalue").is(":checked") && $(".color").is(":checked")) {
                    console.log("Checked");
                    if ($(".variantvalue:checked").data("id") == $(".color:checked").data("id")) {
                        $(".stockstatus").css("display", "none");
                        addtowishlist();
                    } else {
                        $(".stockstatus").html("This Combination is not in Stock");
                        $(".stockstatus").css("display", "block");
                    }
                } else {
                    alert("please Select Variant Details");
                }


            });

            function addtowishlist() {
                var product_id = {!! json_encode($pro_data->id) !!};
                var user = {!! json_encode(Session::get('user_id')) !!};
                $.ajax({
                    type: "POST",
                    url: '/addtowishlist',
                    data: {
                        productid: product_id,
                        userid: user,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == "already in Wishlist") {
                            Swal.fire({
                                title: "Wishlist",
                                text: "This Product is Already in your Wishlist",
                                icon: "error"
                            })
                        } else if (response == 1) {
                            Swal.fire({
                                title: "Add to Wishlist",
                                text: "Product is Added in your Wishlist",
                                icon: "success"
                            });
                        } else {
                            console.log(response);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            $(document).on('click', '#addtocartbtn', function() {
                if ($(".variantvalue").is(":checked") && $(".color").is(":checked")) {
                    addtocart();
                } else {

                    $(".stockstatus").html("please Select Variant Details");
                    $(".stockstatus").css("display", "block");
                    hidemessage()
                }
            });



            $(document).on("change", ".color", function() {
                if ($(".variantvalue").is(":checked")) {
                    if ($(".variantvalue:checked").data("id") == $(".color:checked").data("id")) {
                        var priceid = parseInt($(this).data("id"));
                        $(".product_price").html("₹ " + variantPrice[priceid]);
                        $("#addtocartbtn").css("display", "block");
                    } else {
                        $(".stockstatus").html("This Combination is not in Stock");
                        $(".stockstatus").css("display", "block");
                        $("#addtocartbtn").css("display", "none");
                        hidemessage()
                    }

                } else {
                    alert("Please Select " + {!! json_encode($variantData[0]->variant_name) !!} + " First");
                    $(this).prop("checked", false);
                }
            });


            $(document).on("change", ".variantvalue", function() {
                if($(".color").is(":checked"))
                {

                    if ($(".variantvalue:checked").data("id") == $(".color:checked").data("id")) {
                        var priceid = parseInt($(this).data("id"));
                        $(".product_price").html("₹ " + variantPrice[priceid]);
                        $("#addtocartbtn").css("display", "block");
                    } else {
                        $(".stockstatus").html("This Combination is not in Stock");
                        $(".stockstatus").css("display", "block");
                        $("#addtocartbtn").css("display", "none");
                        hidemessage()
                    }
                }
            });


            function hidemessage() {
                setTimeout(() => {
                    $(".stockstatus").css("display", "none");
                }, 3000);
            }


            function addtocart() {
                if (user_id) {
                    var p_price = $('.product_price').html();
                    var price = p_price.split(" ");

                    var product_data = {
                        "product_id": {!! json_encode($pro_data->id) !!},
                        "product_name": {!! json_encode($pro_data->name) !!},
                        "product_measurement_value": $('.variantvalue:checked').val() ? $('.variantvalue:checked').val() : '',
                        "product_measurement" : {!! json_encode($variantData[0]->variant_name) !!},
                        "product_image": "product_images/" + {!! json_encode($product_images[0]) !!},
                        "product_color": $('.color:checked').val() ? $('.color:checked').val() : '',
                        "product_quantity": $('.qty').val(),
                        "product_price": parseInt(price[1], 10),
                        "category_id": product['category_id'],
                    };

                    console.log(product_data);

                    $.ajax({
                        type: "POST",
                        url: '/addtocart',
                        data: product_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response == 1) {
                                Swal.fire({
                                    title: "Added to Cart!",
                                    text: "Product is Added to Cart.",
                                    icon: "success",
                                }).then((result) => {
                                    window.location.href = "{{ route('addtocart') }}";
                                }).catch((err) => {

                                });;
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                        }
                    });
                } else {

                }
            }
        });
    </script>
</body>

</html>
