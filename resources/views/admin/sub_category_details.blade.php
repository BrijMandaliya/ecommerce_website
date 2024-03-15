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

        #subcategorytable {
            border-radius: 10px;
        }

        #subcategorytable tbody tr {
            justify-content: center;
            border-radius: 20px;
        }

        table {
            border-radius: 20px;
        }

        table td {
            text-align: center;
        }

        #sub_category_fields {
            padding: 0px 30px;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    @if (Session::has('addcategorysuccess'))
        <script>
            swal('Done!', "{{ Session::get('addcategorysuccess') }}", 'success', {
                timer: 2000,
            });
        </script>
    @endif
    @if (Session::has('UpdateCategorySuccessfully'))
        <script>
            swal('Done!', "{{ Session::get('UpdateCategorySuccessfully') }}", 'success', {
                timer: 2000,
            });
        </script>
    @endif

    <div style="float:right;margin-right:30px;">
        <a class="btn btn-secondary" id="addSubCategoryBtn" type="button">Add +</a>
    </div>

    <div class="mt-5" style="margin-left: 260px;margin-right:30px;width:80%">
        <center>
            <table class="table table-hover" id="subcategorytable" style="width: 100%;">
                <thead style="position: sticky; top: 0;">
                    <th style="width: 30px;">Action</th>
                    <th style="width: 30px;">ID</th>
                    <th>Sub Category Name</th>
                    <th>Parent Category Name</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" id="subCategoryModel" tabindex="-1" role="dialog" aria-labelledby="subCategoryModelTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 1200px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Sub Category</h5>
                </div>
                <div class="modal-body">

                    <body>
                        <div class="container" style="width: 800px;">
                            <form method="POST" class="addSubCategoryForm" id="addsubcategoryform"
                                enctype="multipart/form-data">
                                @csrf
                                <table id="subcategoryaddtable">
                                    <tr id="firstrow">
                                        <td id="sub_category_fields">
                                            <div class="mb-3">
                                                <label for="subCategoryName" class="form-label">Sub Category Name</label>
                                                <input type="text" class="form-control" id="subCategoryName" name="subCategoryName"
                                                    required>
                                            </div>
                                        </td>
                                        <td id="sub_category_fields">
                                            <div class="mb-3">
                                                <label for="parent_category" class="form-label">Category Image</label>
                                                <select class="form-select" name="parent_category" id="parent_category"
                                                    required>
                                                    <option value="" selected disabled>Select Parent Category
                                                    </option>
                                                    @foreach ($catData as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
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
                                    <button id="sub_category_btn" type="submit" class="btn btn-dark">Add</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {


            getSubCategoryData();

            function getSubCategoryData() {
                $('#subcategorytable tbody tr').remove();
                $.ajax({
                    url: "{{ route('get-sub-category') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            response.forEach(element => {

                                var row = `<tr>
                                    <td><div class="dropdown">
                                <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &#8942;
                                </a>
                                <div class="dropdown-menu h-auto" aria-labelledby="threeDotMenu">
                                    <a class="dropdown-item editbtn" id="editbtn" value=` + element[
                                    'id'] + `
                                        data-id=` + element.id + `>Edit</a>
                                    <a class="dropdown-item deletebtn" id="deletebtn" value=` + element[
                                    'id'] + `
                                        data-id=` + element.id + `>Delete</a>
                                </div>
                            </div></td>
                                    <td>` + element.id + `</td>
                                    <td>` + element.sub_category_name + `</td>
                                    <td>` + element.parent_category.name + `</td>
                                    </tr>`;

                                $('#subcategorytable tbody').append(row);
                            });
                        }
                    }
                })
            }


            $(document).on('click', '#editbtn', function() {
                var subCatgoryId = $(this).data("id");
                $("#subCategoryModel").modal("show");
                $("#sub_category_btn").html("Update");
                $(".addSubCategoryForm").attr("id", "updatesubcategoryform");

                $.ajax({
                    url: "{{ route('edit-sub-category') }}",
                    type: "POST",
                    data: "id=" + subCatgoryId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        $("#subCategoryName").val(response.sub_category_name);
                        $("#parent_category").val(response.parent_category_id);

                        var subCategoryID = $("<input>",{
                            type : "hidden",
                            id: "subCategoryId",
                            name: "subCategoryId",
                            value: response.id,
                        });
                        $("#firstrow").append(subCategoryID);
                    }
                });
            });

            $(document).on('click', '#closebtn', function() {
                $("#subCategoryModel").modal("hide");
            });

            $(document).on('click', '#deletebtn', function() {
                var subCatgoryId = $(this).data("id");
                $.ajax({
                    url: "{{ route('delete-sub-category') }}",
                    type: "POST",
                    data: "id=" + subCatgoryId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Sub Category Deleted SuccessFully",
                                icon: "success"
                            });
                            getSubCategoryData();
                        }
                    }
                });
            });

            $(document).on('click', '#addSubCategoryBtn', function() {
                $("#subCategoryModel").modal("show");
                $('.addSubCategoryForm')[0].reset();
                $("#sub_category_btn").html("Add");
                $(".addSubCategoryForm").attr("id", "addsubcategoryform");
            });

            $(document).on('submit', '.addSubCategoryForm', function(event) {
                event.preventDefault();
                var formdata = $(this).serializeArray();
                submitform(formdata, $(this))
            });

            function submitform(formdata, element) {
                if (element.attr("id") == "addsubcategoryform") {
                    $.ajax({
                        url: "{{ route('add_sub_category') }}",
                        type: "POST",
                        data: formdata,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 1) {
                                $("#subCategoryModel").modal('hide');
                                Swal.fire({
                                    title: "Success!",
                                    text: "Sub Category Added SuccessFully",
                                    icon: "success"
                                }).then((result) => {
                                    getSubCategoryData();
                                }).catch((err) => {
                                    console.log(err);
                                });;


                            }
                        }
                    });
                } else if (element.attr("id") == "updatesubcategoryform") {
                    $.ajax({
                        url: "{{ route('update-sub-category') }}",
                        type: "POST",
                        data: formdata,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 1) {
                                Swal.fire({
                                    title: "Updated!",
                                    text: "Sub Category Updated SuccessFully",
                                    icon: "success"
                                });
                                $("#subCategoryModel").modal('hide');
                                getSubCategoryData();
                            }
                        }
                    });
                }

            }

        });
    </script>

</body>

</html>
