<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-Z2z5q8v7BzOVjp0uPn9mlU41BtKDUQxbs+Rt3SDo8S+d53FXTI9vRj2fRV13k5lM" crossorigin="anonymous"> --}}

    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <link href="{{ asset("css/admin_panel/nucleo-svg.css") }}" rel="stylesheet" /> --}}
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs  shadow border-radius-xl my-1 fixed-start ms-1"
        id="sidenav-main" style="border-radius: 10px;background-color: rgb(165, 225, 230)">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" target="_blank">
                <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold" style="font-size: 15px;">Ecommerce Website</span>
            </a>
        </div>
        <div class="collapse navbar-collapse" style="height: 100%;" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                @if (Session::has('usertype'))
                    @if (Session::get('usertype') == 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ $adminpage == 'dashboard' ? 'active' : '' }}" href="/admin/dashboard">
                                <div
                                    class="fa-solid fa-store  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'product_details' ? 'active' : '' }}"
                                href="/admin/productdetails">
                                <div
                                    class=" fa-brands fa-product-hunt  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Product</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ $adminpage == 'dashboard' ? 'active' : '' }}" href="/admin/dashboard">
                                <div
                                    class="fa-solid fa-store  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'product_details' ? 'active' : '' }}"
                                href="/admin/productdetails">
                                <div
                                    class=" fa-brands fa-product-hunt  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">


                                </div>
                                <span class="nav-link-text ms-1">Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'order_details' ? 'active' : '' }}"
                                href="/admin/orderdetails">
                                <div
                                    class=" fa-solid fa-o icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                                </div>
                                <span class="nav-link-text ms-1">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $adminpage == 'user_details' ? 'active' : '' }} "
                                href="/admin/userdetails">
                                <div
                                    class="fa-regular fa-user  icon-shape shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">User Details</span>
                            </a>

                        </li>


                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'category_details' ? 'active' : '' }}"
                                href="/admin/categorydetails">
                                <div
                                    class="fa-solid fa-cubes-stacked  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'sub_category_details' ? 'active' : '' }}"
                                href="/admin/subcategorydetails">
                                <div
                                    class="fa-solid fa-cubes-stacked  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Sub Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'brand_details' ? 'active' : '' }}"
                                href="/admin/branddetails">
                                <div
                                    class="fa-solid fa-cubes-stacked  icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Brand</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ $adminpage == 'discount_coupon' ? 'active' : '' }}"
                                href="/admin/discountcoupon">
                                <div
                                    class="fa-solid fa-ticket icon-shape  shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                </div>
                                <span class="nav-link-text ms-1">Discount Coupon</span>
                            </a>
                        </li>
                    @endif

                    <hr>
                    <li class="nav-item" style="height: 50px;margin-left:30px;">
                        <a class=" btn btn-info dropdown-toggle" style="" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user mr-3"></i>{{ Session::get('name') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                            style="width: 30px;margin-top:-10px;border-radius:10px;height:auto;">
                            <a class="dropdown-item shadow" style="font-size:15px;" href="/adminlogin"> <span
                                    class="fa-solid fa-right-from-bracket"></span> Log out</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </aside>


    <script src="https://kit.fontawesome.com/d1cb15daae.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
