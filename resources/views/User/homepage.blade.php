<!DOCTYPE html>
<html lang="en">

<head>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    <style>
        .discountcoupon .card {
            width: 350px;
            padding: 10px;
            border-radius: 20px;
            background: rgb(73, 139, 151);
            border: none;
            color: #fff;
            height: 350px;
            display: flex;
            position: relative;
            align-items: center;
            justify-content: center;
        }

        .discountcoupon .container {
            height: 100vh;
        }

        .discountcoupon .card h1 {
            font-size: 48px;
            margin-bottom: 0px;
        }

        .discountcoupon.card span {
            font-size: 28px;
        }

        .discountcoupon .image {
            position: absolute;
            opacity: .1;
            left: 0;
            top: 0;
        }

        .discountcoupon .image2 {
            position: absolute;
            bottom: 0;
            right: 0;
            opacity: .1;
        }
    </style>
</head>

<body>

    <center>
        <div class="modal fade" id="discountcouponmodal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" role="document">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content w-auto" style="background-color:transparent;border-width: 0px;">
                    <div class="modal-body discountcoupon">
                        {{-- <button type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                          </button> --}}
                        <div class="card">
                            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner discount_coupon_carousel">
                                    <div class="carousel-item active" style="height: auto;">
                                        <h1 class="discount-rate">50% OFF</h1><span class="d-block on-category">On
                                            Everything</span><span class="d-block discount-till">Today</span>
                                        <div class="mt-4 discount-code"><small>With Code : bbbootstrap2020</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </div> --}}
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                    </div>
                    {{-- <div class="modal-footer">

                </div> --}}
                </div>
            </div>
        </div>
    </center>

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            @include('User.header')
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="{{ asset('electronic-gadgets.jpeg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                    Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Affordable Price</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="{{ asset('clothe.jpg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                    Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Clothes</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @foreach ($cat_data as $category)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{ $category->count }}</p>
                        <a href="/displayporduct/{{ $category->id }}"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset('category_images/' . $category->c_image) }}"
                                alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Categories End -->


    {{-- <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="img/offer-2.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End --> --}}


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($pro_data as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div
                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <?php
                            $product_images = explode(',', $product->p_image_1);
                            ?>
                            <img class="img-fluid w-100" style="height: 250px;"
                                src="{{ asset('product_images/' . $product_images[0]) }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>₹ {{ $product->price }}</h6>
                            </div>
                        </div>

                        @if (Session::has('userlogin'))
                            <div class="card-footer d-flex justify-content-center bg-light border">
                                <a href="/productdetail/{{ $product->id }}" class="btn btn-sm text-dark p-0"
                                    style="font-size: 20px;"><i class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->



    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-1.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-2.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-3.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-4.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-5.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-6.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-7.jpg') }}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ asset('user/img/vendor-8.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    @include('User.footer');



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>


    <script>
        $(document).ready(function() {
            var discount_data = {!! json_encode($discount_data) !!};
            console.log(discount_data);
            console.log(discount_data[0].discount_active_time.split("T"));
            if (discount_data) {
                var till_date = discount_data[0].discount_active_time.split("T");
                var date = new Date(Date.parse(till_date));
                const months = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                console.log(date.getDate() + " " + months[date.getMonth()] + ", " + date.getFullYear());
                till_date = date.getDate() + " " + months[date.getMonth()] + ", " + date.getFullYear();
                var current_date = new Date();



                $(".discount-rate").html(discount_data[0].discount_rate + "% OFF");
                $(".on-category").html("on " + discount_data[0].c_name);
                $(".discount-code").html("With Code : " + discount_data[0].discount_code);
                $(".discount-till").html("Till : " + till_date);
                $("#discountcouponmodal").modal("show");

                discount_data.forEach((element, index) => {
                    if (index > 0) {
                        var till_date = element.discount_active_time.split("T");
                        var date = new Date(Date.parse(till_date));
                        if ((current_date - date) < 0) {
                            till_date = date.getDate() + " " + months[date.getMonth()] + ", " + date
                                .getFullYear();

                            var carouselitem = `
                                                    <div class="carousel-item" style="height: auto;">
                                                        <h1 class="discount-rate">` + element.discount_rate +
                                `% OFF</h1><span class="d-block on-category">  on ` + element
                                .c_name + `</span><span class="d-block discount-till"> Till : ` +
                                till_date + `</span>
                                                        <div class="mt-4 discount-code"><small>With Code : ` + element
                                .discount_code + `</small></div>
                                                    </div>`;
                            $(".discount_coupon_carousel").append(carouselitem);
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
