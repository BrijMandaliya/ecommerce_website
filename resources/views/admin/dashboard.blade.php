

<!DOCTYPE html>
<html lang="en">


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .p_images {
            transition: transform .20s;
        }

        .p_images:hover {
            transform: scale(1.5);
        }

        #ordersortby {
            width: 100px;
        }

        /* .ordersortbytable tbody tr {
            height: 40px;
        } */
        .topsellingproductrow {
            height: 30px;
        }
    </style>
</head>

<body class="bg-gray-100">
    @include('admin.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h4 class="font-weight-bolder mb-0">Dashboard</h4>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">


                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/small-logos/logo-spotify.svg"
                                                    class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Order</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $today_order }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $userdatacount }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa-solid fa-user text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="height: 200px;">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Order</p>
                                        <h3 class="font-weight-bolder mb-0">

                                        @if(Session::has('admin_id'))
                                            {{ $order->count() }}
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa-solid fa-o text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Product</p>
                                        <h3 class="font-weight-bolder mb-0">
                                            {{ $product_count }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa-brands fa-product-hunt  text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6" style="margin-top: -100px;">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Active User</p>
                                        <h3 class="font-weight-bolder mb-0 active-user">

                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="fa-brands fa-product-hunt  text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-10" style="margin-top: -100px;width:50%;height:20%;">

                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body p-3">
                    <div class="row">

                        <div class="modal fade" id="getproductsfromdate" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" role="document" >
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content" >
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Products</h5>
                                    </div>
                                    <div class="modal-body" >
                                        <div class="container">
                                            <table class="table">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Product Color</th>
                                                    <th>Product Quantity</th>
                                                </thead>
                                                <tbody id="getporductfromdate">

                                                </tbody>
                                            </table>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <canvas id="myAreaChart" width="100%" height="30%"></canvas>
                        <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"
                            integrity="sha512-7DgGWBKHddtgZ9Cgu8aGfJXvgcVv4SWSESomRtghob4k4orCBUTSRQ4s5SaC2Rz+OptMqNk0aHHsaUBk6fzIXw=="
                            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script type="text/javascript">
                            function getdatafromdate(date) {
                                $.ajax({
                                    url: "/getdatafromdate",
                                    type: "POST",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        _date: date,
                                    },
                                    success: function(response) {
                                        $("#getproductsfromdate").modal("show");
                                        var tbodyContent = '';
                                        $.each(response, function(index, product) {
                                            tbodyContent += `<tr>` +
                                                `<td>` + (index + 1) + `</td>` +
                                                `<td>` + product.product_name + `</td>` +
                                                `<td>` + product.product_price + `</td>` +
                                                `<td>` + product.product_color + `</td>` +
                                                `<td>` + product.product_quantity + `</td>` +
                                                `</tr>`;
                                        });
                                        $('#getporductfromdate').html(tbodyContent);
                                    },
                                    error:function(error)
                                    {
                                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                                    }
                                });
                            }
                            _ydata = JSON.parse('{!! json_encode(array_reverse($created_date)) !!}');
                            _xdata = JSON.parse('{!! json_encode(array_reverse($quantity)) !!}');
                            // _ydata.unshift(0);
                            // _xdata.unshift(0);
                        </script>
                        <script src="{{ asset('js/chart-area-demo.js') }}"></script>
                    </div>


                </div>
            </div>
            <div class="row my-3">

                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <h4 class="col-12" style="width: 80%;">Top 5 Order</h4>
                                <select class="col form-select" style="width: 50px;margin-bottom:20px;"
                                    name="" id="ordersortby">
                                    <option value="id" selected>Sort By</option>
                                    <option value="product_quantity">Product Quantity</option>
                                    <option value="product_price">Product Price</option>
                                </select>
                            </div>
                            <div class="row" style="font-size: 13px;">
                                <table class="table table-striped ordersortbytable" style="height: 300px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Product Quantity</th>
                                            <th scope="col">Product Color</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ordersortbytablebody" style="text-align: center;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="col-12" style="width: 80%;">Top Selling 5 Product By Quantity</h4>
                            <div class="row" style="font-size: 13px;">
                                <table class="col table table-striped topsellingproducttable" style="height: auto;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Total Sell Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="topsellingproductbody" style="text-align: center;">
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="col-12 mt-5" style="width: 80%;">Top Selling 5 Product By Price</h4>
                            <div class="row" style="font-size: 13px;float-right;">
                                <table class="col mt-3 table table-striped topsellingproductbypricetable"
                                    style="height: auto;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Total Sell Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="topsellingproductbypricebody" style="text-align: center;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold"
                                    target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    {{-- <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script> --}}

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script> --}}

    <script>
        $(document).ready(function() {

            getorders("id");
            gettopsellingproduct();
            gettopsellingproductbyprice();

            $('#ordersortby').on('change', function() {
                var sort_by = $(this).val();
                getorders(sort_by);
            });

            function getorders(sort_by) {
                $.ajax({
                    url: "/getorderbysort",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        sortby: sort_by,
                    },
                    success: function(response) {
                        var tbodyContent = '';
                        $.each(response, function(index, order) {
                            tbodyContent += `<tr>` +
                                `<td>` + (index + 1) + `</td>` +
                                `<td>` + order.invoice_no + `</td>` +
                                `<td>` + order.product_name + `</td>` +
                                `<td>` + order.product_quantity + `</td>` +
                                `<td>` + order.product_color + `</td>` +
                                `</tr>`;
                        });
                        $('#ordersortbytablebody').html(tbodyContent);
                    },
                    error:function(error){
                        console.log(error);
                        // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            }


            function gettopsellingproduct() {
                $.ajax({
                    url: "/gettopsellingproduct",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var tbodyContent = '';
                        $.each(response, function(index, product) {
                            tbodyContent += `<tr class="topsellingproductrow">` +
                                `<td>` + (index + 1) + `</td>` +
                                `<td>` + product.product_id + `</td>` +
                                `<td>` + product.product_name + `</td>` +
                                `<td>` + product.total_product_quantity + `</td>` +
                                `</tr>`;
                        });
                        $('#topsellingproductbody').html(tbodyContent);
                    },
                    error:function(error)
                    {

                        console.log(error);
                        // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            }

            function gettopsellingproductbyprice() {
                $.ajax({
                    url: "/gettopsellingproductbyprice",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var tbodyContent = '';
                        $.each(response, function(index, product) {
                            tbodyContent += `<tr class="topsellingproductrow">` +
                                `<td>` + (index + 1) + `</td>` +
                                `<td>` + product.product_id + `</td>` +
                                `<td>` + product.product_name + `</td>` +
                                `<td>` + product.total_product_price + `</td>` +
                                `</tr>`;
                        });
                        $('#topsellingproductbypricebody').html(tbodyContent);
                    },
                    error:function(error){
                        console.log(error);
                        // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            }

            getactiveuser()
            setInterval(getactiveuser, 2000);

            function getactiveuser() {
                $.ajax({
                    url: "/getactiveuser",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        $(".active-user").html(response.length);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred:", error);
                    }
                });
            }





        });
    </script>
</body>

</html>
