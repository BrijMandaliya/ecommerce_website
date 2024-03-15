
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Your Wishlist</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">wishlist</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3" id="product_display_item">

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    @include('User.footer')


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

            var element = $('#product_display_item');
            var products = {!! json_encode($pro_data) !!};

            getproducts();
            function getproducts() {
                element.find('.product-items').remove();
                console.log(products);
                products.forEach(product => {
                    var productImages = product.p_image_1.split(',');
                    var productHtml = `
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product-items">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" style="height: 230px" src="{{ asset('product_images/') }}/${productImages[0]}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">${product.name}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6 id="product_price">₹ ${product.price}</h6>
                                    </div>
                                </div>`;
                    @if (Session::has('userlogin'))
                        productHtml += `
                                <div class="card-footer d-flex justify-content-center bg-light border">
                                    <a href="/productdetail/${product.product_id}" class="btn btn-sm text-dark p-0" style="font-size: 20px;"><i
                                        class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <a class="btn btn-sm text-dark p-0 deletefromwishlist" id="${product.wishlist_id}" style="font-size: 20px;"><i
                                        class="fas fa-trash text-danger ml-5"></i></a>
                            </div>
                            `;
                    @endif
                    productHtml += `
                            </div>
                        </div>`;

                    element.append(productHtml);
                });
            }

            $(document).on('click', '.deletefromwishlist', function() {
                product_wishlist_id = $(this).attr('id');
                $.ajax({
                    url: '/deleteproductfromwishlist',
                    type: 'POST',
                    data: "id=" + product_wishlist_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        element.find('.product-items').remove();
                       window.location.reload();
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });

            });
        });
    </script>
</body>

</html>
