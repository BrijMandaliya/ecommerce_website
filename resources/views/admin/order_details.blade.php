<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .billingaddress {
            width: 50px;
        }

        .order_status{
            background-color: transparent;
        }

        #btn-update {
            display: none;
        }



        .image-index {
            position: absolute;
            margin-left: -35px;
            margin-top: 20px;
            opacity: 0;
        }

        .images input {
            margin-top: 20px;
            margin-left: 8px;
        }

        .images label {
            margin-left: 10px;
            font-size: 20px;
        }

        #pimage1,
        #p_images {
            transition: transform .20s;
            width: 60px;
            height: 60px;
            margin: 10px;
        }

        #pimage1:hover,
        #p_images:hover {
            transform: scale(1.5);
            width: 70px;
            height: 70px;
        }

        thead {
            background-color: rgb(12, 126, 141);
            color: white;
        }

        #product_table {
            border-radius: 10px;
            background-color: rgb(196, 230, 238);
        }

        #product_table tbody tr {
            justify-content: center;
            border-radius: 20px;
        }

        .order_status {
            border: none;
            width: 100%;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')


    <center>
        <div style="margin-left: 270px;margin-right:40px;margin-top:50px;">
            <table class="table table-border table-border-radius" id="order_details_table">
                <thead style="position: sticky; top: 1;">
                    <th>Action</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>product_total_price</th>
                    <th>product_size</th>
                    <th>product_color</th>
                    <th>Invoice Number</th>
                    <th>Delivery Status</th>
                    <th>Billing address</th>
                    <th>Shipping Address</th>
                    <th>Product Image</th>
                </thead>
                <tbody style="align-items: center;">
                </tbody >
            </table>
        </div>
    </center>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#order_details_table').DataTable();
            getorderdetails();

            function getorderdetails() {
                table.clear().draw();
                $.ajax({
                    type: 'POST',
                    url: '/getorders',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        response.forEach(element => {
                            var p_image = element['product_image'];
                            var image =
                                `<img src="{{ asset('`+p_image+`') }}" height="100" width="100" />`;
                            var address;
                            element['billingaddress'] = element['billingaddress'].replace(
                                /\/n/g, "<br>");

                            if(element['shippingaddress'] !== "same as billing address")
                            {
                                element['shippingaddress'] = element['shippingaddress'].replace(
                                /\/n/g, "<br>");
                            }


                            var row =[`<div class="dropdown">
                                <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &#8942;
                                </a>
                                <div class="dropdown-menu" aria-labelledby="threeDotMenu">
                                    <a class="dropdown-item deletebtn" id="deletebtn" value=` + element[
                                    'invoice_no'] + `
                                        data-id=` + element['id'] + `>Delete</a>
                                </div>`,
                                element['user_name'],
                                element['product_name'],
                                element['product_quantity'],
                                element['product_price'],
                                element['product_size'],
                                element['product_color'],
                                element['invoice_no'],
                                `<input type="text" class="order_status" value="` + element[
                                    'order_status'] + `" readonly />
                                <br><br><a class="btn btn-edit" value="` + element['invoice_no'] +
                                `"><i class="fa-solid fa-pencil"></i></a><a class="btn btn-update" id="btn-update"><i class="fa-solid fa-check"></i></a>`,
                                '<p>' + element['billingaddress'] + '</p>',
                                '<p>' + element['shippingaddress'] + '</p>',
                                image];
                            table.row.add(row).draw();
                        });
                    },
                    error: function(error) {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    },
                });
            }

            $(document).on('click', '.btn-edit', function() {
                $(this).parent().find('#btn-update').css('display', 'inline-block');
                $(this).parent().find('.order_status').removeAttr('readonly');
                $(this).parent().find('.order_status').addClass('form-control');
            });

            $(document).on('click', '.btn-update', function() {
                var thiselement = $(this);
                var orderstatus = $(this).parent().find('.order_status').val();
                var invoiceno = $(this).parent().find('.btn-edit').attr('value');

                $.ajax({
                    url: "/updateorderstatus",
                    type: "POST",
                    data: {
                        invoice_no: invoiceno,
                        order_status: orderstatus,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            Swal.fire({
                                title: "Update!",
                                text: "Order Status has been Updated.",
                                icon: "success"
                            }).then(() => {
                                thiselement.parent().find('.order_status').attr(
                                    'readonly', true);
                                thiselement.parent().find('.order_status').removeClass(
                                    'form-control');
                                thiselement.css('display', 'none');
                                getorderdetails();
                            });

                        }
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            });

            $(document).on('click','#deletebtn',function(){
                console.log($(this).attr('value'));
                var invoiceno = $(this).attr('value');
                $.ajax({
                    url: "/deleteorder",
                    type: "POST",
                    data: {
                        invoice_no: invoiceno,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Order has been Deleted.",
                                icon: "success"
                            }).then(() => {
                                getorderdetails();
                            });
                        }
                        else
                        {
                            console.log(response);
                        }
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
