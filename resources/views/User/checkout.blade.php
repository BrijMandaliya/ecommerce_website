
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Cart</p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">

                @if (!empty($orders))
                    <script>
                        new_billing_address = false;
                        old_billing_address_ = {!! json_encode($orders->billingaddress) !!};
                    </script>
                    <h4 class="mt-5 mb-3">Shipping and Billing to this Address</h4>
                    <div class="card" style="padding: 30px;">
                        {!! str_replace('/n', '<br>', $orders->billingaddress) !!}
                    </div>
                @else
                    <script type="text/javascript">
                        new_billing_address = true;
                    </script>
                @endif

                <div class="custom-control custom-checkbox mt-5">
                    <input type="checkbox" class="custom-control-input" id="billingto" name="billingto">
                    <label class="custom-control-label billingto-label" for="billingto" data-toggle="collapse"
                        data-target="#billing-address">Different Billing address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="shipto" name="shipto">
                    <label class="custom-control-label" for="shipto" data-toggle="collapse"
                        data-target="#shipping-address">Ship to different address</label>
                </div>


                <div class="collapse mb-4 mt-4" id="billing-address">

                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <form id="billingaddressform" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="firstName">First Name<span class="text-danger">*</span></label>
                                <input id="firstName" name="firstName" class="form-control" type="text"
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="lastName">Last Name<span class="text-danger">*</span></label>
                                <input id="lastName" name="lastName" class="form-control" type="text"
                                    placeholder="Last Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">E-mail<span class="text-danger">*</span></label>
                                <input id="email" name="email" class="form-control" type="email"
                                    placeholder="Email" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phoneNumber">Mobile No<span class="text-danger">*</span></label>
                                <input id="phoneNumber" name="phoneNumber" class="form-control" type="number"
                                    placeholder="Phone Number" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="addressLine1">Address Line 1<span class="text-danger">*</span></label>
                                <input id="addressLine1" name="addressLine1" class="form-control" type="text"
                                    placeholder="Address Line 1" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="addressLine2">Address Line 2<span class="text-danger">*</span></label>
                                <input id="addressLine2" name="addressLine2" class="form-control" type="text"
                                    placeholder="Address Line 2" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="country">Country<span class="text-danger">*</span></label>
                                <input id="country" name="country" class="form-control" type="text"
                                    placeholder="Country" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="city">City<span class="text-danger">*</span></label>
                                <input id="city" name="city" class="form-control" type="text"
                                    placeholder="City" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="state">State<span class="text-danger">*</span></label>
                                <input id="state" name="state" class="form-control" type="text"
                                    placeholder="State" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="zipCode">ZIP Code<span class="text-danger">*</span></label>
                                <input id="zipCode" maxlength="6" name="zipCode" class="form-control"
                                    type="number" placeholder="Zip Code" required>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="collapse mb-4 mt-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <form id="shiptodiffform" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="shipFirstName">First Name<span class="text-danger">*</span></label>
                                <input id="shipFirstName" name="shipFirstName" class="form-control" type="text"
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipLastName">Last Name<span class="text-danger">*</span></label>
                                <input id="shipLastName" name="shipLastName" class="form-control" type="text"
                                    placeholder="Last Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipEmail">E-mail<span class="text-danger">*</span></label>
                                <input id="shipEmail" name="shipEmail" class="form-control" type="email"
                                    placeholder="Email" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipPhoneNumber">Mobile No<span class="text-danger">*</span></label>
                                <input id="shipPhoneNumber" name="shipPhoneNumber" class="form-control"
                                    type="number" placeholder="Phone Number" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipAddressLine1">Address Line 1<span class="text-danger">*</span></label>
                                <input id="shipAddressLine1" name="shipAddressLine1" class="form-control"
                                    type="text" placeholder="Address Line 1" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipAddressLine2">Address Line 2<span class="text-danger">*</span></label>
                                <input id="shipAddressLine2" name="shipAddressLine2" class="form-control"
                                    type="text" placeholder="Address Line 2" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="country">Country<span class="text-danger">*</span></label>
                                <input id="country" name="shipcountry" class="form-control" type="text"
                                    placeholder="Country" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipCity">City<span class="text-danger">*</span></label>
                                <input id="shipCity" name="shipCity" class="form-control" type="text"
                                    placeholder="City" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipState">State<span class="text-danger">*</span></label>
                                <input id="shipState" name="shipState" class="form-control" type="text"
                                    placeholder="State" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipZIPCode">ZIP Code<span class="text-danger">*</span></label>
                                <input id="shipZIPCode" maxlength="6" name="shipZIPCode" class="form-control"
                                    type="number" placeholder="Zip Code" required>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        @foreach ($pro_data as $products)
                            <div class="d-flex justify-content-between">
                                <p>{{ $products->product_name }}</p>
                                <p class="product_price" data-product-category="{{ $products->category_id }}"
                                    data-product-price="{{ $products->product_price * $products->product_quantity }}">
                                    ₹ {{ $products->product_price * $products->product_quantity }}</p>
                            </div>
                        @endforeach

                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium allproductprice"></h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Free Shipping</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium text-success discount_price">0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold allproductpriceafterdiscount"></h5>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-header border-0">
                        <h4 class="font-weight-semi-bold m-0">Discount Coupon</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="discount_coupon" class="control-label">Enter Coupon</label>
                            <input type="text" class="form-control form-input" id="discount_coupon"
                                name="discount_coupon" style="text-transform: uppercase;" minlength="7"
                                maxlength="7" />
                            <i class="fas fa-trash float-right mt-3 ml-2 deletecoupon" style="display: none;"></i>
                            <i class="fas fa-edit float-right mt-3  editcoupon" style="display: none;"></i>
                            <p id="discount_code_error_msg" class="text-danger"></p>

                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button id="applydiscountcoupon" type="submit"
                            class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Apply
                            Coupon</button>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Cash On Delivery</label>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button id="placeorder" type="submit"
                            class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                            Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->

    @include('User.footer')



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>



    <script>
        $(document).ready(function() {


            var p_price = 0;
            var discount_rate = 0;
            var discount_id = 0;
            var discount_apply_on_category = " ";

            if (new_billing_address == true) {
                $("#billing-address").addClass("show");
                $("#billingto").prop("checked", true);
                $("#billingto").css("display", "none");
                $(".billingto-label").css("display", "none");
            }


            $("#applydiscountcoupon").on("click", function() {
                var discount_code = $("#discount_coupon").val();
                if (discount_code.length < 7) {
                    $("#discount_code_error_msg").html("Enter 7 Character Discount Code");
                } else {
                    $.ajax({
                        url: "/checkdiscountcode",
                        type: 'POST',
                        data: "coupon=" + discount_code,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            $("#discount_code_error_msg").css("display", "block");
                            $("#discount_code_error_msg").attr("class", "text-danger");
                            if (response.length < 1) {
                                $("#discount_code_error_msg").html("Invalid Coupon");
                            } else if (response == "Coupon Has Expiry") {
                                $("#discount_code_error_msg").html("Coupon has Expiry");
                            } else if (response == "Invalid Coupon") {
                                $("#discount_code_error_msg").html("Invalid Coupon");
                            } else if (response == "Coupon Has Already Used") {
                                $("#discount_code_error_msg").html("Coupon Has Already Used");
                            } else if (response == "This Coupun is not Applicable For You") {
                                $("#discount_code_error_msg").html(
                                    "This Coupun is not Applicable For You");
                            } else {
                                $("#discount_code_error_msg").attr("class", "text-success");
                                $("#discount_code_error_msg").html("Code Is Corrected");



                                $("#discount_coupon").attr("readonly", true);

                                $(".editcoupon").css("display", "block");
                                $(".deletecoupon").css("display", "block");

                                discount_id = parseInt(response[0].id);

                                discount_rate = parseInt(response[0]
                                    .discount_rate);

                                discount_apply_on_category = response[0]
                                    .discount_on_category;

                                var t_price = totalfromcategory(discount_apply_on_category);
                                var discount_price = (parseInt(t_price) * discount_rate) / 100;
                                console.log(t_price);
                                if (t_price == 0) {

                                    $("#discount_code_error_msg").attr("class", "text-danger");
                                    $("#discount_code_error_msg").html(
                                        "Coupon is Correct but not Apply in any of your products in This Cart Because Coupon Category is not any of them"
                                    );
                                } else {
                                    $(".discount_price").html(discount_price);
                                    $('.allproductpriceafterdiscount').html("₹ " + (p_price -
                                        discount_price));
                                }



                            }
                        },
                        error: function(error) {
                            console.log(error);
                            // window.location.href = '/error/' + error.status + '/' +
                            //     encodeURIComponent(error.statusText);
                        }
                    })
                }
            });

            $("#discount_coupon").on("input", function() {
                $("#discount_code_error_msg").css("display", "none");
                $(".editcoupon").css("display", "none");
                $(".deletecoupon").css("display", "none");
            });


            function totalfromcategory(category_id) {
                var productPrices = $('.product_price').map(function() {
                    if ($(this).attr('data-product-category') == category_id) {
                        return parseInt($(this).attr('data-product-price'));
                    }
                }).get();

                var price = 0;
                productPrices.forEach(element => {
                    price += element;
                });

                return price;
            }

            $(".editcoupon").click(function() {
                $(this).parent().find("#discount_coupon").removeAttr("readonly");
                $(this).css("display", "none");
            });

            $(".deletecoupon").click(function() {
                $(this).parent().find("#discount_coupon").val(" ");
                $(this).parent().find("#discount_coupon").removeAttr("readonly");
                $(this).css("display", "none");
                $(".editcoupon").css("display", "none");
                $(".allproductpriceafterdiscount").html(p_price);
                $(".discount_price").html("0");
                $("#discount_code_error_msg").css("display", "none");
                discount_rate = 0;
            });


            var product_price = $('.product_price').map(function(event) {
                return parseInt($(this).attr('data-product-price'));
            }).get();


            product_price.forEach(element => {
                p_price += element;
            });
            $('.allproductprice').html("₹ " + p_price);
            $('.allproductpriceafterdiscount').html("₹ " + p_price);

            var billingform = {},
                shiptodiffform, mergeform;
            var check;
            $("#placeorder").click(function() {


                if ($("#billingto").is(':checked')) {
                    if ($("#billingaddressform")[0].checkValidity()) {
                        $("#billingaddressform").submit();


                    } else {
                        alert("Please fill out all required fields in the billing address.");
                    }
                } else {
                    if ($("#shipto").is(':checked')) {
                        // Check validity of the shipping address form
                        if ($("#shiptodiffform")[0].checkValidity()) {
                            $("#shiptodiffform").submit();
                        } else {
                            alert("Please fill out all required fields in the shipping address.");
                        }
                    } else {

                        placeorder({}, old_billing_address_);




                    }

                }
            });


            $(document).on('submit', '#billingaddressform', function(event) {
                event.preventDefault(); // Prevent the default form submission

                billingform = $(this).serializeArray();
                $.ajax({
                    url: "{{ route('billingcheckoutcheckout') }}",
                    type: 'POST',
                    data: billingform,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        billingform = response;
                    },
                    error: function(error) {
                        window.location.href = '/error/' + error.status + '/' +
                            encodeURIComponent(error.statusText);
                    }
                }).then((result) => {
                    if (!$("#shipto").is(':checked')) {
                        placeorder(billingform)
                    }
                }).catch((err) => {

                });
            });

            $(document).on('submit', '#shiptodiffform', function(event) {
                event.preventDefault(); // Prevent the default form submission

                shiptodiffform = $(this).serializeArray();
                $.ajax({
                    url: "{{ route('billingcheckoutcheckout') }}",
                    type: 'POST',
                    data: shiptodiffform,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        shiptodiffform = response;
                    },
                    error: function(error) {
                        window.location.href = '/error/' + error.status + '/' +
                            encodeURIComponent(error.statusText);
                    }
                }).then((result) => {
                    mergeform = $.extend(billingform, shiptodiffform);

                    placeorder(mergeform, old_billing_address_)

                }).catch((err) => {
                    console.log(err);
                });
            });

            function placeorder(addressform, oldbillingaddress) {


                check = $("#shipto").is(':checked') ? true : false;
                checkbilling = $("#billingto").is(':checked') ? true : false;

                var product_details = {!! json_encode($pro_data) !!};


                addressform = $.extend(addressform, {
                    shiptodiffadddress: check,
                    billingtodiffaddress: checkbilling,
                    old_billing_address: new_billing_address !== true ? oldbillingaddress : " ",
                });

                var discount_data = {
                    discountrate: discount_rate,
                    discountapply_on_category: discount_apply_on_category,
                    discount_id: discount_id,
                }

                console.log(discount_data);

                $.ajax({
                    url: "/placeorder",
                    type: 'POST',
                    data: {
                        placeorder: addressform,
                        product_detail: product_details,
                        discountdata: discount_data,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            Swal.fire({
                                title: "Order SuccessFully",
                                text: "Your Order Place SuccessFull",
                                icon: "success"
                            }).then((result) => {
                                window.location.href = "/order";
                            }).catch((err) => {
                                console.log(err);
                            });;
                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            }
        });
    </script>
</body>

</html>
