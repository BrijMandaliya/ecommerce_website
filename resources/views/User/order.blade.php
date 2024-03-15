
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">



    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>




</head>

<body>


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            @include('User.header')
        </div>
    </div>
    <!-- Navbar End -->

    <div class="mt-5">
        <h2>
            Your Orders
        </h2>
    </div>
    <hr>
    <div class="row">
        @foreach ($order_detail as $key => $orders)
            <div class="col-xl products" id="{{ $orders->id }}"
                style="border:1px solid black;margin: 10px;width:650px;height:300px;max-width: 100%;">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <!-- Image -->
                    <div class="row">
                        <img src="{{ asset($orders->product_image) }}" class="m-2" alt="Blue Jeans Jacket"
                            style="width: 150px;height:150px;" />
                    </div>
                    <!-- Image -->
                </div>

                <div cclass="col-lg-5 col-md-6 mb-4 mb-lg-0" style="margin-left: 200px;margin-top: -130px;">
                    <!-- Data -->
                    <p class="text-dark"><strong>{{ $orders->product_name }}</strong></p>

                    <p>Color: <span class="text-dark">{{ $orders->product_color }}</span></p>

                    <p>{{ $orders->product_measurement }}: <span class="text-dark">{{ $orders->product_measurement_value }}</span></p>

                    <p>Quantity: <span class="text-dark">{{ $orders->product_quantity }}</span></p>

                    <p>Price: <span class="text-dark">₹ {{ $orders->product_price }}</span></p>
                    <!-- Data -->
                </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0"style="margin-left: 350px;margin-top: -170px;">
                    <!-- Data -->
                    <div class="row">
                        <p>Expected Delivery Date: </p>
                    </div>
                    <div class="row">
                        <p class="text-dark">{{ $orders->expected_delivery_date }}</p>
                    </div>
                    <div class="row">
                        <p>Delivery Status:</p>
                    </div>
                    <div class="row">
                        <p class="text-dark">{{ $orders->order_status }}</p>
                    </div>
                    <!-- Data -->
                </div>

                <div class="col ml-3 float-right" style="margin-left: 350px;">
                    @if ($orders->order_status != 'Out For Delivery')
                        <span class="d-inline-block cancelorder" tabindex="0" id="{{ $orders->invoice_no }}"
                            data-toggle="tooltip" title="Cancel Order" style="float:right;">
                            <dotlottie-player
                                src="https://lottie.host/8a7d8465-0534-41b7-b508-825880218961/AxjjArzE7y.json"
                                background="transparent" speed="1" style="width: 50px; height: 50px;"
                                autoplay></dotlottie-player>
                        </span>
                    @endif
                    <span class="d-inline-block invoiceno" tabindex="0" id="{{ $orders->invoice_no }}"
                        data-toggle="tooltip" title="View Invoice" style="float: right;margin-top:-20px;">
                        <dotlottie-player src="{{ asset('invoice.json') }}" background="transparent" speed="1"
                            style="width: 100px; height: 80px;" loop autoplay></dotlottie-player>
                    </span>
                </div>
            </div>
        @endforeach

        <button class="btn" style="pointer-events: none;" type="button"><i class="fa-solid fa-xmark"></i></button>


    </div>


    @include('User.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>







    <script>
        $(document).ready(function() {

            $(document).on('click', '.invoiceno', function() {
                var invoice_no = $(this).attr('id');
                invoice_no = invoice_no.substring(1, invoice_no.length)
                console.log(invoice_no);
                window.location.href = "/displayinvoice/" + invoice_no;
            });

            $(document).on('click', '.cancelorder', function() {
                var invoice_no = $(this).attr('id');
                console.log(invoice_no);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Cancel Order!",
                    cancelButtonText: "No, Abort!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '/cancelorder',
                            data: {
                                invoiceno: invoice_no,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response);
                                if (response == 1) {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });


            });
        });
    </script>
</body>

</html>
