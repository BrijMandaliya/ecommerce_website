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
            background-color: rgb(12, 126, 141);
            color: white;
        }

        #product_table {
            width: 800px;
            border-radius: 10px;
            overflow-x: scroll;
        }

        #product_table tbody tr {
            justify-content: center;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    @include('admin.sidebar')


    <div class="container" style="margin-left:300px;margin-top:50px;width:75%;">
        <h3 class="text-dark">Enter Product Details</h3>
        <form method="POST" action="/addproduct" class="productform" id="addproductform" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($cat_data as $cat)
                        <option data-measurement="{{ $cat->category_measurement }}" value="{{ $cat->id }}">
                            {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subCatgory" class="form-label">Sub Category</label>
                <select class="form-select" id="subCatgory" name="subCatgory" required>
                    <option value="" selected>Select Sub Category</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <select class="form-select" id="brand" name="brand" required>
                    <option value="" selected>Select Brand</option>
                </select>
            </div>

            <div class="collapse mb-3 catmeasurement">
                <div class="row">
                    <div class="col-2">
                        <label for="measurementName" id="catMeasurement" class="form-label">Enter</label>
                        <input type="hidden" id="categoryMeasurement" name="measurementName">
                        <input type="text" class="form-control" id="measurementName" name="measurementValue[]"
                            required>
                    </div>
                    <div class="col-2">
                        <label for="measurementColor" class="form-label">Enter Color</label>
                        <input type="text" class="form-control" id="measurementColor" name="measurementColor[]">
                    </div>
                    <div class="col-2">
                        <label for="measurementStock" class="form-label">Enter Stock</label>
                        <input type="number" min="1" class="form-control" id="measurementStock"
                            name="measurementStock[]" required>
                    </div>
                    <div class="col-2">
                        <label for="measurementPrice" class="form-label">Enter Price</label>
                        <input type="number" class="form-control" id="measurementPrice" name="measurementPrice[]"
                            required>
                    </div>
                    <div class="col-3">
                        <label for="measurementImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="measurementImage" name="measurementImage[]">
                    </div>
                    <div class="col">
                        <a class="btn btn-primary mt-4 add-catmeasurement">+</a>
                    </div>

                </div>
            </div>

            <div class="mb-3">
                <label for="shortDescription" class="form-label">Short Description</label>
                <input type="text" class="form-control" id="shortDescription" name="shortDescription" required>
            </div>

            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea id="Description" class="form-control" name="Description" required></textarea>
            </div>


            <div class="mb-3">
                <label for="Price" class="form-label">Price</label>
                <input type="number" class="form-control" id="Price" name="Price" min="0" required>
            </div>

            <div class="mb-3 images">
                <label for="p_image_1" class="form-label">Images:</label>
                <input type="file" name="p_image_1[]" id="p_image_1">
                <p class="text-danger image_error_msg" style="display: none;"></p>
            </div>

            <div class="mt-3" style="float:right">
                <button id="product_btn" type="submit" class="btn btn-dark">Add</button>
            </div>

        </form>
    </div>





    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            var catMeasurement, i = 1;


            $('#category').on('change', function() {
                var cat = $(this).val();
                catMeasurement = $(this).find(":selected").data('measurement');
                $("#subCatgory").find('option').not(':first').remove();
                getsubcategory(cat);
                $("#catMeasurement").html("Enter " + catMeasurement);
                $(".catMeasurementLabel").html("Enter " + catMeasurement);
                console.log(catMeasurement);
                $("#categoryMeasurement").val(catMeasurement);
                console.log(catMeasurement);
            });

            function getsubcategory(catid) {
                $.ajax({
                    url: '/getsubcategory',
                    type: 'POST',
                    data: 'catid=' + catid,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        response.forEach(element => {
                            var row = `<option value="` + element.id + `"> ` + element
                                .sub_category_name + `</option>`;
                            $("#subCatgory").append(row);
                        });
                    },
                    error: function(error) {

                    },
                }).then((result) => {
                    $(".catmeasurement").addClass("show");
                }).catch((err) => {

                });
            }

            function getbrand(subCat)
            {
                $.ajax({
                    url: '{{ route('get-brand') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log(response);
                        response.forEach(element => {
                            if (element.sub_category_id.includes(subCat)) {
                                var row = `<option value="` + element.id + `"> ` +
                                    element.brand_name + ` </option>`;
                                $("#brand").append(row);
                            }

                        });
                    },
                    error: function(error) {

                    },
                });
            }

            $("#subCatgory").on('change', function() {
                var subCat = $(this).val();
                $("#brand").find('option').not(':first').remove();
                getbrand(subCat);
            });

            $(".add-catmeasurement").on('click', function() {
                console.log($(this).parent().parent().attr('class'));

                var row = `<div class="row" >
                    <div class="col-2">
                        <label for="measurementName" id="catMeasurement" class="form-label">Enter</label>
                        <input type="text" class="form-control" id="measurementName" name="measurementValue[]"
                            required>
                    </div>
                    <div class="col-2">
                        <label for="measurementColor" class="form-label">Enter Color</label>
                        <input type="text" class="form-control" id="measurementColor"
                            name="measurementColor[]">
                    </div>
                    <div class="col-2">
                        <label for="measurementStock" class="form-label">Enter Stock</label>
                        <input type="number" min="1" class="form-control" id="measurementStock"
                            name="measurementStock[]" required>
                    </div>
                    <div class="col-2">
                        <label for="measurementPrice" class="form-label">Enter Price</label>
                        <input type="number" class="form-control" id="measurementPrice" name="measurementPrice[]"
                            required>
                    </div>
                    <div class="col-3">
                        <label for="measurementImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="measurementImage" name="measurementImage[]">
                    </div>
                    <div class="col">
                        <a class="btn btn-danger mt-4 remove-catmeasurement">-</a>
                    </div>
            </div>`;

                $(this).parent().parent().parent().append(row);
                $(".catMeasurementLabel").html("Enter " + catMeasurement);
                $("#categoryMeasurement").val(catMeasurement);

            });




            $(document).on("click", ".remove-catmeasurement", function() {
                i--;
                $(this).parent().parent().remove();

            });




        });
    </script>
</body>

</html>
