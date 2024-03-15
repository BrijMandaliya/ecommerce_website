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
        .action-option a {
            margin: 10px;
            width: 150px;

        }

        .description {
            width: 200px;
            white-space: wrap;
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
            background-color: rgb(97, 163, 172);
            color: white;
            text-align: center;
        }

        thead tr:first-child {
            background-color: white;
            color: black;
        }

        #product_table thead tr th input {
            transition: transform .20s;
            width: 150px;
            border: 1px solid rgb(97, 163, 172);
            border-radius: 10px;
            padding: 5px 10px;
        }

        #product_table thead tr th input:hover {
            transform: scale(1.1);
            border: 2px solid rgb(97, 163, 172);
            height: 35px;
        }


        #product_table{
            width: 800px;
            border-radius: 10px;
            overflow-x: scroll;
        }

        #product_table tbody tr {
            justify-content: center;
            border-radius: 20px;
        }

        .searchbar {
            width: 150px;
        }

    </style>
</head>

<body>

    @include('admin.sidebar')

    @if (Session::has('admin_active_time'))
        <div style="float:right;margin-right:50px;margin-top:20px;">
            <a href="/admin/product_add" class="btn btn-secondary" id="addproductbtn" type="button">Add +</a>
        </div>
    @endif


    <center>
        <div class="mt-5" style="margin-left: 270px;margin-right:40px;">
            <select class="form-select w-25 float-left mb-4 product_table_columns" name="product_table_columns"
                id="product_table_columns">
                <option class="m-10" value="">Select Column</option>
            </select>
            <table class="table-border table-border-radius" id="product_table">
                <thead style="position: sticky; top: 1;">
                    <tr>
                        <th></th>
                        <th><input type="text" placeholder=" Name" class="searchbar" id="s_name"></th>
                        <th><input type="text" placeholder=" ShortDescrption" class="searchbar"
                                id="s_shortdescription"></th>
                        <th><input type="text" placeholder=" Description" class="searchbar" id="s_description"></th>
                        <th><input type="text" placeholder=" Price" class="searchbar" id="s_price"></th>
                        <th><input type="text" placeholder=" Category" class="searchbar" id="s_category"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>shortDescription</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </center>




    <div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 1000px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="productmodeltitle">Add Product</h5>
                </div>
                <div class="modal-body">

                    <div class="admininfo">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Product Post Details</td>
                                </tr>
                                <tr>
                                    <td>User IP</td>
                                    <td>:</td>
                                    <td class="userIP">192.168.1.106</td>
                                </tr>
                                <tr>
                                    <td>Post By User</td>
                                    <td>:</td>
                                    <td class="userID">5</td>
                                </tr>
                                <tr>
                                    <td>Product Posted At</td>
                                    <td>:</td>
                                    <td class="product_Created_At">14-2-2024</td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Product Update Details</td>
                                </tr>
                                <tr>
                                    <td>Update User IP</td>
                                    <td>:</td>
                                    <td class="updateUserIP">192.168.1.106</td>
                                </tr>
                                <tr>
                                    <td>Update By User</td>
                                    <td>:</td>
                                    <td class="updateUserID">5</td>
                                </tr>
                                <tr>
                                    <td>Product Updated At</td>
                                    <td>:</td>
                                    <td class="product_Updated_At">14-2-2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="variantdetails">
                        <table class="table variantDetails">
                            <thead>
                                <th>Variant Name</th>
                                <th>Variant Value</th>
                                <th>Variant Colour</th>
                                <th>Variant Price</th>
                                <th>variant Stock</th>
                            </thead>
                            <tbody style="text-align: center;">

                            </tbody>
                        </table>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
    <script>
        $(document).ready(function() {

            $(".s_name").on("input", function() {
                console.log($(this).val());
                table.columns(1).search($(this).val(), true, false).draw();
            });

            var table = $("#product_table").DataTable({
                serverSide: true,
                processing: true,
                Dom: '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>rt<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
                ajax: {
                    data: function(d) {
                        // console.log(d.columns);
                        d.columns.forEach((element, index) => {
                            if (index > 0) {
                                var column =
                                    '<option style="background-color:rgb(171, 235, 235);padding:5%;" value="' +
                                    index + '" data-id="' + index + '" >' + element.data +
                                    '</option>';
                                $(".product_table_columns").append(column);
                            }
                        });
                    }
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        width: '20px',
                        orderable:false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'shortDescription',
                        name: 'shortDescription',
                    },
                    {
                        data: 'Description',
                        name: 'Description',
                    },
                    {
                        data: 'price',
                        name: 'price',
                        visible: true,
                    },
                    {
                        data: 'category_name',
                        name: 'category.name',
                        title: 'Category Name',
                        orderable: false,
                    },
                    {
                        data: 'p_image_1',
                        name: 'p_image_1',
                        render: function(data, type, full, meta) {
                            if (data) {
                                var images = data.split(",");
                                images = images.slice(0, -1);
                                var productimages = "";
                                images.forEach(element => {
                                    productimages += "<img id='p_images' src='" +
                                        '{{ asset('/product_images/') }}' + '/' +
                                        element + "' height='80'/>";
                                });

                                return productimages;

                            } else {
                                return "";
                            }
                        },
                    },
                ],
            });

            $("#s_name").on("input", function() {
                table.columns(1).search($(this).val(), true, false).draw();
            });
            $("#s_shortdescription").on("input", function() {
                table.columns(2).search($(this).val(), true, false).draw();
            });
            $("#s_description").on("input", function() {
                table.columns(3).search($(this).val(), true, false).draw();
            });
            $("#s_price").on("input", function() {
                table.columns(4).search($(this).val(), true, false).draw();

            });
            $("#s_category").on("input", function() {
                table.columns(5).search($(this).val(), true, false).draw();
                var columns = table.settings().init().columns;
            });

            $(".product_table_columns").on("click", function() {
                if ($(this).val() > 0) {

                    if(table.columns($(this).val()).visible()[0] == false)
                    {
                        table.columns($(this).val()).visible(true);
                        $(this).find("option").eq($(this).val()).css("background-color", "rgb(171, 235, 235)");
                    }
                    else
                    {
                        table.columns($(this).val()).visible(false);
                        $(this).find("option").eq($(this).val()).css("background-color", "white");
                    }
                }
                $(this).prop("selectedIndex", 0);


            });



            var variantData = {!! json_encode($variantData) !!};




            $(document).on("click", "#variantbtn", function() {
                var productID = $(this).data('id');
                $('#ProductModal').modal('show');
                $("#productmodeltitle").html("Variant Details");
                $('.modal-body .container').css("display", "none");
                $('.modal-body .admininfo').css("display", "none");
                $(".variantdetails").css("display", "block");
                $(".variantDetails tbody tr").remove();

                variantData.forEach(element => {
                    if (element.product_id == productID) {
                        var row = `<tr>
                            <td>` + element.variant_name + `</td>
                            <td>` + element.variant_value + `</td>
                            <td>` + element.variant_colour + `</td>
                            <td>` + element.variant_price + `</td>
                            <td>` + element.variant_stock + `</td>
                            </tr>`;

                        $(".variantDetails tbody").append(row);
                    }
                });


            });


            $('#closebtn').click(function() {
                $('#ProductModal').modal('hide');

            });



            // Manually toggle dropdown
            $(document).on('click', '#threeDotMenu', function() {
                $('.dropdown-menu').removeClass('show');
                $(this).siblings('.dropdown-menu').toggleClass('show');
            });


            // Hide dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });



            //Check Where form belongs to Add Product or Update Product
            function check() {

                var image_div = $("#product_images")[0];
                var pro_id = $("#product_id")[0];

                if (image_div) {
                    image_div.parentNode.removeChild(image_div);
                }
                if (pro_id) {
                    pro_id.parentNode.removeChild(pro_id);
                }

                if ($('#addproductform').hasClass('updateproductform')) {
                    $(document).on('submit', '.updateproductform', function(e) {
                        e.preventDefault();

                        $('.updateproductform').removeAttr('id');
                        const formupdateData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: '/updateproduct',
                            data: formupdateData,
                            processData: false,
                            contentType: false,
                            success: function(response) {

                                if (response == 1) {
                                    $('#ProductModal').modal('hide');
                                    Swal.fire({
                                        title: "Update!",
                                        text: "Your Data has been Updated.",
                                        icon: "success"
                                    });
                                    getproductdetails();
                                } else {
                                    console.log(response);
                                }

                            },
                            error: function(error) {
                                console.log(error);
                                // window.location.href = '/error/' + err.status + '/' +
                                //     encodeURIComponent(err.statusText);
                            },
                        }).then((result) => {
                            $('.updateproductform').attr('id', 'addproductform');

                        }).catch((err) => {
                            console.log(error);
                            // window.location.href = '/error/' + err.status + '/' +
                            //     encodeURIComponent(err.statusText);
                        });;
                    });
                } else {
                    $('#addproductform').submit(function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('addproduct') }}',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response == 1) {
                                    Swal.fire({
                                        title: "Added!",
                                        text: "Your Data has been Added.",
                                        icon: "success"
                                    }).then(() => {
                                        $('#ProductModal').modal('hide');

                                        getproductdetails();
                                    });
                                } else if (response == "Image is Greater Than 100KB") {
                                    $(".image_error_msg").css("display", "none");
                                    $(".image_error_msg").html("Image is Greater Than 100KB");
                                }
                            },
                            error: function(error) {
                                // console.log(error.responseText);
                                $(".image_error_msg").css("display", "block");
                                $(".image_error_msg").html(error.responseText);
                                $("#p_image_1").val('');

                                // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                            },
                        });
                    });
                }
            }


            //Delete Product Function for Delete Product
            $(document).on('click', '#deletebtn', function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var deleteid = $(this).attr('value');
                        $.ajax({
                            type: 'POST',
                            url: '/deleteproduct',
                            data: "id=" + deleteid,
                            dataType: 'JSON',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then(() => {

                                    getproductdetails();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                Swal.fire({
                                    title: "Error",
                                    text: "An error occurred. Please check the console for details.",
                                    icon: "error"
                                });
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });

            });


            //Info Button Function for Get Information about which Admin has Post the product
            $(document).on("click", "#infobtn", function() {
                $('#ProductModal').modal('show');
                $("#productmodeltitle").html("Information");
                $('.modal-body .container').css("display", "none");
                $('.modal-body .variantdetails').css("display", "none");
                $(".admininfo").css("display", "block");
                var productid = $(this).attr('value');
                $.ajax({
                    type: 'POST',
                    url: '/getproductinfo',
                    data: "id=" + productid,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        if (response) {

                            var usersnames = response[0].User_Name.split(",");
                            $(".userIP").html(response[0].user_ip);
                            $(".userID").html(usersnames[0]);
                            $(".product_Created_At").html(response[0].created_at.replace(
                                /T|\.000000Z/g,
                                " "));
                            $(".updateUserIP").html(response[0].update_user_ip);
                            $(".updateUserID").html(usersnames[1] == null ? response[0]
                                .User_Name : usersnames[1]);
                            $(".product_Updated_At").html(response[0].updated_at.replace(
                                /T|\.000000Z/g,
                                " "));


                        }
                    },
                    error: function(error) {
                        console.log(error);
                        // window.location.href = '/error/' + error.status + '/' +
                        //     encodeURIComponent(error.statusText);
                    }
                });

            });


        });
    </script>
</body>

</html>
