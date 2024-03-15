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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>


    <style>
        thead {
            background-color: rgb(12, 126, 141);
            color: white;
        }

        #brandtable {
            border-radius: 10px;
        }

        #brandtable tbody tr {
            justify-content: center;
            border-radius: 20px;
        }

        table {
            border-radius: 20px;
        }

        table td {
            text-align: center;
        }

        #brand_fields {
            padding: 0px 30px;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    <div style="float:right;margin-right:30px;">
        <a class="btn btn-secondary" id="addbrandBtn" type="button">Add +</a>
    </div>

    @if (Session('addBrandSuccessFully'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "Brand Added SuccessFully",
                icon: "success"
            });
        </script>
    @endif

    <div class="mt-5" style="margin-left: 260px;margin-right:30px;width:80%">
        <center>
            <table class="table table-hover" id="brandtable" style="width: 100%;">
                <thead style="position: sticky; top: 0;">
                    <th style="width: 30px;">Action</th>
                    <th style="width: 20px;">#</th>
                    <th>Brand Name</th>
                    <th>Brand Logo</th>
                    <th>Sub Category Name</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" id="brandModel" tabindex="-1" role="dialog" aria-labelledby="brandModelTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: auto;margin-left:-250px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Brand</h5>
                </div>
                <div class="modal-body">

                    <body>
                        <div class="container" style="width: 1000px;">
                            <form method="POST" action="{{ route('add-brand') }}" class="addbrandForm"
                                id="addbrandform" enctype="multipart/form-data">
                                @csrf
                                <table id="brandaddtable">
                                    <tr id="firstrow">
                                        <td id="brand_fields">
                                            <div class="mb-3">
                                                <label for="brandName" class="form-label">Brand Name</label>
                                                <input type="text" class="form-control" id="brandName"
                                                    name="brandName" required>
                                            </div>
                                        </td>
                                        <td id="brand_fields">
                                            <div class="mb-3 brand_Logo">
                                                <label for="brandlogo" class="form-label">Brand Logo</label>
                                                <input type="file" class="form-control" id="brandLogo"
                                                    name="brandLogo" required>
                                            </div>
                                        </td>
                                        <td id="brand_fields">
                                            <div class="mb-3">
                                                <label for="subCategory" class="form-label">Sub Category</label>
                                                <select class="form-select" name="subCategory[]" id="subCategory"
                                                    style="width:200px;" required multiple>
                                                    @foreach ($subCategory as $sub_category)
                                                        <option value="{{ $sub_category->id }}">
                                                            {{ $sub_category->sub_category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <div class="mt-3" style="float:right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        id="closebtn">Close</button>
                                    <button id="brandSubmitBtn" type="submit" class="btn btn-dark">Add</button>
                                </div>
                            </form>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                    </body>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {

            getdata();

            function getdata() {
                $.ajax({
                    url: "{{ route('get-brand-data') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            response.forEach((element, index) => {
                                var row = `<tr>
                                    <td><div class="dropdown">
                                    <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        &#8942;
                                    </a>
                                    <div class="dropdown-menu h-auto" aria-labelledby="threeDotMenu">
                                        <a class="dropdown-item editbtn" id="editbtn" data-id=` + element
                                    .id + `>Edit</a>
                                        <a class="dropdown-item deletebtn" id="deletebtn" data-id=` +
                                    element.id + `>Delete</a>
                                    </div>
                                    </div></td>
                                    <td>` + (index + 1) + `</td>
                                    <td>` + element.brand_name + `</td>
                                    <td> <img src="{{ asset('brand_logos/`+element.brand_logo+`') }}" width="80px" height="70px" /></td>
                                    <td>` + element.sub_category_id.replace(/,/g, "<br>") + `</td>
                                    </tr>`;

                                $("#brandtable tbody").append(row);
                            });
                        }
                    },
                });
            }

            $("#addbrandBtn").on('click', function() {
                $("#brandModel").modal("show");
                $('.addbrandForm')[0].reset();
                $('.addbrandForm').attr("action", "{{ route('add-brand') }}");
                $("#firstrow").find("#brand_Logo_image").remove();
                $("#firstrow").find("#brandID").remove();
                $("#brandLogo").prop("required", true);

            });

            $("#closebtn").on('click', function() {
                $("#brandModel").modal("hide");
            });

            $(document).on("click", "#deletebtn", function() {
                var brandId = $(this).data("id");
                $.ajax({
                    url: "{{ route('delete-brand-data') }}",
                    type: "POST",
                    data: "id=" + brandId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Brand Deleted SuccessFully",
                                icon: "success"
                            });
                        }
                    },
                });
            });

            $(document).on("click", "#editbtn", function() {
                $('.addbrandForm').attr("action", "{{ route('update-brand') }}");
                $("#brandLogo").removeAttr("required");

                var brandId = $(this).data("id");
                $.ajax({
                    url: "{{ route('edit-brand') }}",
                    type: "POST",
                    data: "id=" + brandId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        var subCat = response.sub_category_id.split(",");
                        $("#brandModel").modal("show");
                        $("#brandName").val(response.brand_name);
                        $("#subCategory").val(subCat);
                        var img = $("<img>", {
                            src: "{{ asset('brand_logos/') }}/" + response.brand_logo,
                            id: "brand_Logo_image",
                            style: "border:1px solid black;width:60px;height:60px;float:right;",
                        });



                        if ($("#brandID").val()) {
                            $("#brandID").val(response.id);
                        } else {
                            var brandID = $("<input>", {
                                type: "hidden",
                                name: "brandID",
                                id: "brandID",
                                value: response.id,
                            });

                            $(".brand_Logo").append(img);
                        }

                        $("#firstrow").append(brandID);
                    },
                });
            });
        });
    </script>

</body>

</html>
