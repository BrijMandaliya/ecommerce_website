<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        @page {
            size: A4;
            margin: 70px;
        }

        body {
            font-size: 12px;
        }

        table tbody tr td {
            vertical-align: top;
        }

        .custom-table {
            border: 1px solid #2b3958;
        }

        .custom-table thead {
            background: #2f71c1;
        }

        .custom-table thead th {
            border: 0;
            color: #ffffff;
        }

        .custom-table>tbody tr:hover {
            background: #ccd1da;
        }

        .custom-table>tbody tr:nth-of-type(even) {
            /* background-color: #1a243a; */
        }

        .custom-table>tbody td {
            border: 1px solid #2e3d5f;
        }

        .table {
            /* background: #1a243a; */
            color: black;
            font-size: .75rem;
            width: 100%;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row">

            <div class="invoice-container" style="width: 100%;">
                <div class="invoice-header">
                    @if ($downloadbtn)
                        <!-- Row start -->
                        <div class="row gutters " style="margin-top: 20px;">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="custom-actions-btns mb-5">
                                    <?php
                                        $invoice_no = $orders->first()->invoice_no;
                                        $invoice_no = substr($invoice_no, 1);
                                    ?>
                                    <a href="/downloadinvoice/{{ $invoice_no }}" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                          </svg>
                                    </a>
                                    <a href="/printinvoice/{{ $invoice_no }}" class="btn btn-outline-primary" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                          </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    @endif

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 float-left">
                            <a class="invoice-logo">
                                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
                                </h1>
                            </a>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 float-right">
                            <div class="float-right">
                                <div>Invoice Number : {{ $orders->first()->invoice_no }}
                                </div>
                                <div>Place Order Date :
                                    {{ $orders->first()->order_placed_date }}</div>
                                <div>Expected Delivery Date :
                                    {{ $orders->first()->expected_delivery_date }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->


                </div>

                <div class="invoice-body">

                    <!-- Row start -->
                    <div class="row" style="margin: 100px 0px 15px 0px;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        To
                                    </td>
                                    <td class="text-right" style="float: right;">
                                        <p>From</p>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>
                                        <address>
                                            {!! str_replace('/n', '<br>', e($orders->first()->billingaddress)) !!}
                                        </address>
                                    </td>
                                    <td style="float: right;vertical-align: top;">
                                        <address class="text-right">
                                            Maxwell admin Inc, 45 NorthWest Street.<br>
                                            Sunrise Blvd, San Francisco.<br>
                                            00000 00000
                                        </address>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- Row end -->



                    <!-- Row start -->
                    <div class="row gutters" style="font-size: 10px;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table custom-table m-0">
                                    <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Product Image</th>
                                            <th>Product Measurement</th>
                                            <th>Product Measurement Value</th>
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total_price = 0; ?>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td style="width: 50%;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td><img src="{{ $downloadbtn ? asset($order->product_image) : public_path ($order->product_image) }}" height="50" width="50" ></td>
                                                <td>{{ $order->product_measurement }}</td>
                                                <td>{{ $order->product_measurement_value }}</td>
                                                <td>{{ $order->product_quantity }}</td>
                                                <td>{{ $downloadbtn ? '₹' : 'Rs' }}
                                                    {{ $order->product_price }}</td>
                                                <?php
                                                $total_price += $order->product_price;
                                                ?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">
                                                <p>
                                                    Subtotal<br>
                                                    Shipping &amp; Handling<br>
                                                    Tax (18% GST)<br>
                                                </p>
                                                <h6 class="text-dark"><strong>Grand Total</strong></h6>
                                            </td>
                                            <td colspan="2">
                                                <p>
                                                    {{ $downloadbtn ? '₹' : 'Rs' }}
                                                    {{ $total_price }}<br>
                                                    Free Shipping<br>
                                                    {{ $downloadbtn ? '₹' : 'Rs' }} <?php $grand_total = $total_price + ($total_price * 18) / 100;
                                                    echo ($total_price * 18) / 100; ?><br>
                                                </p>
                                                <h6 class="text-dark">{{ $downloadbtn ? '₹' : 'Rs' }}
                                                    <b>{{ $grand_total }}</b>
                                                </h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                </div>

                <div class="invoice-footer mt-5 text-center">
                    <h5>Thank you for Shopping from Eshopper.</h5>
                </div>

            </div>
            {{-- </div> --}}
            {{-- </div> --}}

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
