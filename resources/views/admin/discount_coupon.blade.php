<?php

use Carbon\Carbon;

$cat_data = DB::table('categories')->get();

?>
<!DOCTYPE html>
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
        thead {
            background-color: rgb(12, 126, 141);
            color: white;
        }

        #categorytable {
            border-radius: 10px;
            background-color: rgb(196, 230, 238);
        }

        #categorytable tbody tr {
            justify-content: center;
            border-radius: 20px;
        }

        table {
            border-radius: 20px;
        }

        table td {
            text-align: center;
        }

        #category_fields {
            padding: 0px 30px;
        }

        #discount_coupon_fields {
            margin: 10px;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')


    <div style="float:right;margin-right:30px;">
        <a class="btn btn-secondary" id="adddiscountcouponbtn" type="button">Add +</a>
    </div>

    <div class="mt-5" style="margin-left: 260px;margin-right:30px;width:80%">
        <center>
            <table class="table table-hover" id="discountcoupontable" style="width: 100%;">
                <thead style="position: sticky;top:0;">
                    <th style="width: 30px;">Action</th>
                    <th style="width: 30px;">#</th>
                    <th>Discount Coupon</th>
                    <th>Discount Rate</th>
                    <th>Discount Active Time</th>
                    <th>Discount Type</th>
                    <th>Discount on Category</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" id="adddiscountcouponmodel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Discount Coupon</h5>
                </div>
                <div class="modal-body w-100">
                    <center>
                        <form class="w-100 p-3 discountcouponform" method="POST" id="adddiscountcouponform"
                            enctype="multipart/form-data">
                            @csrf
                            <table id="categoryaddtable">
                                <tr id="firstrow">
                                    <td id="discount_coupon_fields" class="discount-code">
                                        <div class="mb-3">
                                            <label for="coupon" class="form-label">Discount Coupon</label>
                                            <input type="text" class="form-control" id="coupon" name="coupon"
                                                required minlength="7" maxlength="7">
                                        </div>
                                    </td>
                                    <td id="discount_coupon_fields" class="discount_active_time">
                                        <div class="mb-3 ml-3">
                                            <label for="discount_coupon_active_time" class="form-label">Discount
                                                Coupon Active Time</label>
                                            <input type="datetime-local" class="form-control"
                                                id="discount_coupon_active_time" name="discount_coupon_active_time"
                                                min="{{ Carbon::now()->format('Y-m-d\TH:i') }}" required>
                                        </div>
                                    </td>
                                    <td id="discount_coupon_fields">
                                        <div class="mb-3 ml-3">
                                            <label for="discount_rate" class="form-label">Discount Coupon Rate (in
                                                %)</label>
                                            <input type="number" class="form-control" id="discount_rate"
                                                name="discount_rate" max="100" min="1" required>
                                        </div>
                                    </td>
                                    <td id="discount_coupon_fields">
                                        <div class="mb-3 ml-3">
                                            <label for="discount_counpon_type" class="form-label">Discount Coupon
                                                Type</label>
                                            <select class="form-select" name="discount_counpon_type" id="discount_counpon_type">
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td id="discount_coupon_fields">
                                        <div class="mb-3 ml-3">
                                            <label for="discount_on_category" class="form-label">Discount on
                                                Category</label>
                                            <select class="form-select" name="dicount_on_category"
                                                id="discount_on_category">
                                                <option value="">Select Category</option>
                                                @foreach ($cat_data as $category)
                                                    <option value="{{ $category->id }}-{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div class="mt-3" style="float:right">
                                <button type="button" class="btn btn-secondary" id="closebtn">Close</button>
                                <button id="discountcoupon_btn" type="submit" class="btn btn-dark">Add</button>
                            </div>
                        </form>
                    </center>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            getdata();

            function getdata() {
                $.ajax({
                    url: '/getdiscountcoupondata',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        coupenhtml = "";
                        if(response.length < 1)
                        {
                            coupenhtml = `<tr>
                                    <td colspan="7">No Data Available<td>
                                </tr>`
                        }

                        response.forEach((coupon, index) => {
                            coupenhtml += `<tr>` +
                                `<td> <div class="dropdown">
                                <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &#8942;
                                </a>
                                <div class="dropdown-menu" aria-labelledby="threeDotMenu">
                                    <a class="dropdown-item editbtn" id="editbtn"
                                        data-id=` + coupon.id + `>Edit</a>
                                    <a class="dropdown-item deletebtn" id="deletebtn"
                                        data-id=` + coupon.id + `>Delete</a>
                                </div>
                            </div> </td>` +
                                `<td>` + (index + 1) + `</td>` +
                                `<td>` + coupon.discount_code + `</td>` +
                                `<td>` + coupon.discount_rate + `% </td>` +
                                `<td>` + coupon.discount_active_time.replace('T', ' ') +
                                `</td>` +
                                `<td>` + coupon.discount_code_type + `</td>` +
                                `<td>` + coupon.name + `</td>` +
                                `</tr>`;
                        });
                        $("#discountcoupontable tbody").html(coupenhtml);
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            }

            $(document).on('click', '#closebtn', function() {
                $("#adddiscountcouponmodel").modal("hide");
            });

            $(document).on('click', '#adddiscountcouponbtn', function() {
                $("#adddiscountcouponmodel").modal("show");
                $(".discount_active_time").css("display", "block");
                $("#discount_coupon_active_time").removeAttr("disabled");
                $("#discountcoupon_btn").html("Add");
                $(".discountcouponform").attr("id", "adddiscountcouponform");
                $(".discountcouponform")[0].reset();
            });


            $(document).on('submit', '#adddiscountcouponform', function(event) {
                event.preventDefault();
                var formdata = $(this).serializeArray();

                $.ajax({
                    url: '/adddiscountcoupon',
                    type: 'POST',
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == 1) {
                            $("#adddiscountcouponmodel").modal("hide");
                            Swal.fire({
                                title: "Success",
                                text: "Add Coupon Code Success Full",
                                icon: "success"
                            });
                            getdata();
                        } else {
                            if (response ==
                                "Already Has Coupon") {
                                Swal.fire({
                                    title: "Error",
                                    text: "Already Has Coupon with Same Category and Coupon Type",
                                    icon: "error"
                                });
                            } else {
                                console.log(response);
                            }
                        }
                    },
                    error:function(error)
                    {
                        console.log(error);
                        // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            });

            $(document).on("submit", "#updatediscountcouponform", function(event) {
                event.preventDefault();
                var form_data = $(this).serializeArray();

                $.ajax({
                    url: '/updatediscountcoupondata',
                    type: 'POST',
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response == 1)
                        {
                            Swal.fire({
                                    title: "Update",
                                    text: "Coupon Update SuccessFully",
                                    icon: "success"
                                });
                                $("#adddiscountcouponmodel").modal("hide");
                                getdata();
                        }
                        else {
                            if (response == "Already Has Coupon") {
                                Swal.fire({
                                    title: "Error",
                                    text: "Already Has Coupon with Same Category and Coupon Type",
                                    icon: "error"
                                });
                            } else {
                                console.log(response);
                            }
                        }
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });
            });


            $(document).on("click", "#editbtn", function() {
                $(".discountcouponform")[0].reset();
                $(".discountcouponform").attr("id", "updatediscountcouponform");
                $("#adddiscountcouponmodel").modal("show");
                $(".discount_active_time").css("display", "none");

                var coupon_id = $(this).data("id");


                $.ajax({
                    url: '/getdiscountcoupondata',
                    type: 'POST',
                    data: "id=" + coupon_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        $("#coupon").val(response[0].discount_code);
                        $("#discount_rate").val(response[0].discount_rate);
                        $("#discount_counpon_type").val(response[0].discount_code_type);
                        $("#discount_on_category").val(response[0].discount_on_category + "-" + response[0].name);
                        $("#discount_coupon_active_time").attr("disabled", true);
                        $("#discountcoupon_btn").html("Update");

                        if ($("#discount_coupon_id").val()) {
                            $("#discount_coupon_id").val(response[0].id);
                        } else {
                            var coupon_id = $("<input>", {
                                type: "hidden",
                                name: "discount_coupon_id",
                                id: "discount_coupon_id",
                                value: response[0].id,

                            });
                            $(".discount-code").append(coupon_id);
                        }
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    }
                });

            });

            $(document).on("click", "#deletebtn", function() {
                var id = $(this).data("id");
                console.log(id);

                $.ajax({
                    url:"/deletediscountcoupon",
                    type:"POST",
                    data:"id="+id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(response)
                    {
                        console.log(response);
                        getdata();
                    },
                    error:function(error)
                    {
                        window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    },
                });
            });

        });
    </script>
</body>

</html>
