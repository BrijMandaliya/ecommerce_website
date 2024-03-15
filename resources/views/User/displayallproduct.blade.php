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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="pricerange" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>

                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="pricerange" class="custom-control-input" id="0 to 100">
                            <label class="custom-control-label" for="0 to 100">₹0 - ₹100</label>

                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="pricerange" class="custom-control-input" id="100 to 200">
                            <label class="custom-control-label" for="100 to 200">₹100 - ₹200</label>

                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="pricerange" class="custom-control-input" id="200 to 300">
                            <label class="custom-control-label" for="200 to 300">₹200 - ₹300</label>

                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="pricerange" class="custom-control-input" id="300 to 400">
                            <label class="custom-control-label" for="300 to 400">₹300 - ₹400</label>

                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="radio" name="pricerange" class="custom-control-input" id="400 to 500">
                            <label class="custom-control-label" for="400 to 500">₹400 - ₹500</label>
                        </div>

                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mt-3">
                            <input type="radio" name="pricerange" class="custom-control-input" id="500 to More">
                            <label class="custom-control-label" for="500 to More">₹500 To Above</label>
                        </div>
                    </form>
                </div>

                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Brand</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="brand" class="custom-control-input" checked id="brand">
                            <label class="custom-control-label" for="brand">All Brand</label>

                        </div>
                        @foreach ($brandData as $key => $bValue)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="radio" name="brand" class="custom-control-input"
                                    data-id="{{ $bValue->id }}" id="{{ 'brand-name' . $key }}">
                                <label class="custom-control-label"
                                    for="{{ 'brand-name' . $key }}">{{ $bValue->brand_name }}</label>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3" id="product_display_item">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchbyname"
                                        placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    {{-- <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script> --}}


    <script>
        $(document).ready(function() {

            var element = $('#product_display_item');
            var products = {!! json_encode($pro_data) !!};
            var brandid;
            getproducts();

            function getproducts(start, end, search) {
                element.find('.product-items').remove();
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
                                <a href="/productdetail/${product.id}" class="btn btn-sm text-dark p-0" style="font-size: 20px;"><i
                                        class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            </div>`;
                    @endif
                    productHtml += `
                            </div>
                        </div>`;
                    var productName = product.name.toLowerCase();
                    var searchText = search ? search.toLowerCase() : "";

                        if (productName.indexOf(searchText) === -1 && search) {
                            // console.log(productName.indexOf(searchText));
                        } else if (!start && !end) {

                            if(brandid)
                            {

                                if(brandid == product.brand_id)
                                {
                                    element.append(productHtml);
                                }
                            }
                            else
                            {
                                element.append(productHtml);
                            }

                        } else {
                            if (start === 500 && product.price >= start) {
                                brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);
                            } else if (start === 0 && end === 100 && product.price > start && product
                                .price < end) {
                                    brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);
                            } else if (start === 100 && end === 200 && product.price >= start && product
                                .price < end) {
                                    brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);
                            } else if (start === 200 && end === 300 && product.price >= start && product
                                .price < end) {
                                    brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);
                            } else if (start === 300 && end === 400 && product.price >= start && product
                                .price < end) {
                                    brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);
                            } else if (start === 400 && end === 500 && product.price >= start && product
                                .price < end) {
                                    brandid ? (brandid == product.brand_id ? element.append(productHtml) : element.append()): element.append(productHtml);element.append(productHtml);
                            }
                        }

                });
            }

            $('#searchbyname').on('input', function() {
                // This function will be called whenever the text in the input field changes
                var searchText = $(this).val();
                // Perform actions based on the new text value

                element.find('.product-items').remove();
                getproducts(undefined, undefined, searchText);
            });



            $(document).on('change', "input[name='pricerange']", function() {
                var selectedRadio = $(this).attr('id');
                element.find('.product-items').remove();
                if (selectedRadio === "price-all") {
                    getproducts();
                } else {
                    if (selectedRadio === '500 to More') {
                        getproducts(500);
                    } else {
                        var parts = selectedRadio.split(" to "); // Split the string into an array at " to "
                        var start = parseInt(parts[0], 10); // Convert the start of the range to an integer
                        var end = parseInt(parts[1], 10); // Convert the end of the range to an integer
                        getproducts(start, end);
                        $.ajax({
                            type: ""
                        });
                    }
                }

            });

            $(document).on('change', "input[name='brand']", function() {
                brandid = $(this).data("id");

                getproducts();
                // console.log(brandID);
            });

        });
    </script>
</body>

</html>
