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
        <a class="btn btn-secondary" id="addcategorybtn" data-toggle="modal" data-target="#exampleModalCenter"
            type="button">Add +</a>
    </div>

    <div class="mt-5" style="margin-left: 260px;margin-right:30px;width:80%">
        <center>
            <table class="table table-hover" id="categorytable" style="width: 100%;">
                <thead style="position: sticky; top: 0;">
                    <th style="width: 30px;">Action</th>
                    <th style="width: 30px;">ID</th>
                    <th>Category Name</th>
                    <th>Category Measurement</th>
                    <th>Category Image</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 1300px;margin-left:-200px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
                </div>
                <div class="modal-body">
                    <body>
                        <div class="container" style="width: 1000px;">
                            <form action="{{ route('add_category') }}" method="POST" id="addcategoryform"
                                enctype="multipart/form-data">
                                @csrf
                                <table id="categoryaddtable">
                                    <tr id="firstrow">
                                        <td id="category_fields">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="name" name="name[]"
                                                    required>
                                            </div>
                                        </td>
                                        <td id="category_fields">
                                            <div class="mb-3">
                                                <label for="c_measurement" class="form-label">Category
                                                    Measurement</label>
                                                <input type="text" class="form-control c_measurement"
                                                    id="c_measurement" name="c_measurement[]" required>
                                            </div>
                                        </td>
                                        <td id="category_fields">
                                            <div class="mb-3">
                                                <label for="c_image" class="form-label">Category Image</label>
                                                <input type="file" class="form-control cat_image" id="c_image"
                                                    name="c_image[]" required>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="button" class="btn btn-primary mt-4" value="+"
                                                id="add">
                                        </td>
                                    </tr>
                                </table>

                                <div class="mt-3" style="float:right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        id="closebtn">Close</button>
                                    <button id="category_btn" type="submit" class="btn btn-dark">Add</button>
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


    <script type="text/javascript">
        $(document).ready(function() {

            var i = 0;

            $('#add').click(function() {
                ++i;
                $('#categoryaddtable').append(
                    `<tr>
                        <td id="category_fields">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name[]" required>
                        </div>
                    </td>
                    <td id="category_fields">
                        <div class="mb-3">
                            <label for="c_measurement" class="form-label">Category Measurement</label>
                            <input type="text" class="form-control c_measurement" id="c_measurement"
                                    name="c_measurement[]" required>
                         </div>
                    </td>
                    <td id="category_fields">
                        <div class="mb-3">
                            <label for="c_image" class="form-label">Category Image</label>
                            <input type="file" class="form-control cat_image" id="c_image"
                                name="c_image[]" required>
                        </div>
                    </td>
                    <td>
                       <button type="button" class="btn btn-danger remove-table-row" id="remove-row">-</button>
                    </td>
                </tr>`);
            });

            $(document).on('click', '#remove-row', function() {
                $(this).closest('tr').remove();
            });


            var table = $('#categorytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/categorydata',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'category_measurement',
                        name: 'category_measurement',
                    },
                    {
                        data: 'c_image',
                        name: 'c_image',
                        render: function(data, type, full, meta) {
                            if (data) {
                                return "<img id='c_image' src='" +
                                    '{{ asset('/category_images/') }}' + '/' +
                                    data + "' height='100'/>";
                            } else {
                                return "";
                            }
                        },
                    },
                ],
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


            // Add Category Function
            $('#addcategorybtn').click(function() {
                $('#exampleModalCenter').modal('show');
                $('.cat_image').prop('required', true);
                $('#add').css('display', 'block');
                if ($('#firstrow').children('.cat_image').length > 0) {
                    $('#cat_image').remove();
                }
                $('#categoryaddtable tr:not(#firstrow)').remove();
                $('#addcategoryform')[0].reset();
            });


            $('#closebtn').click(function() {
                $('#exampleModalCenter').modal('hide');
            });


            // Edit Category Function
            $(document).on('click', '#editbtn', function() {
                var editid = $(this).attr('value');
                $('#add').css('display', 'none');
                $('#categoryaddtable tr:not(#firstrow)').remove();
                $('#exampleModalCenter').modal('show');
                console.log($('#categoryaddtable tr').length);

                $.ajax({
                    type: 'POST',
                    url: '/editcategory',
                    data: "id=" + editid,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#c_measurement').val(response.category_measurement);
                        $('.cat_image').removeAttr('required');
                        $('#category_btn').html('Update');
                        $('#addcategoryform').attr('action', "{{ route('updatecategory') }}");


                        if ($('#firstrow').children('.cat_image').length > 0) {
                            $('.cat_image').attr('src', "{{ asset('category_images/') }}" +
                                "/" + response.c_image);
                        } else {

                            var image = $('<img>', {
                                src: "{{ asset('category_images/') }}" + "/" +
                                    response.c_image,
                                id: 'cat_image',
                                name: 'cat_image',
                                class: 'cat_image',
                                style: 'margin-top:30px;height:100px;',
                            });
                            $('#firstrow').append(image);
                        }

                        if ($('#cat_id').val()) {
                            $('#cat_id').val(response.id);
                        } else {
                            var newinput = $('<input>', {
                                type: 'hidden',
                                id: 'cat_id',
                                name: 'cat_id',
                                value: response.id,
                            });

                            $('#addcategoryform').append(newinput);

                        }
                    },
                    error: function(error) {
                        console.log(error);
                        // window.location.href='/error/' + error.status + '/' + encodeURIComponent(error.statusText);
                    },
                });

            });


            //Delete Category Function
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
                            url: '/deletecategory',
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
                                    table.ajax.reload(null, false);
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
        });
    </script>
</body>

</html>
