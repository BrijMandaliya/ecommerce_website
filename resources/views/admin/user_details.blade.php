<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <style>
        .dropdown-menu {
            min-width: 0;
        }

        .btn-secondary {
            padding: 0.2rem 0.4rem;
        }

        thead {
            background-color: rgb(12, 126, 141);
            color: white;
        }

        #usertable {
            border-radius: 10px;

        }
        #usertable thead {
            position: sticky;
            top: 1;

        }

        #usertable tbody tr {
            justify-content: center;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    @if (Session('AddUserSuccess'))
        <script>

            Swal.fire({
                title: "Success!",
                text: "{{Session('AddUserSuccess')}}",
                icon: "success"
            });
        </script>
    @endif

    @if (Session('UpdateUserSuccessFull'))
        <script>
             Swal.fire({
                title: "updated!",
                text: "{{Session('UpdateUserSuccessFull')}}",
                icon: "success"
            });
        </script>
    @endif

    @include('admin.sidebar')
    <div style="float:right;margin-right:30px;">
        <a class="btn btn-secondary mt-5" id="adduser" data-toggle="modal" data-target="#exampleModalCenter"
            type="button">Add
            +</a>
    </div>
    <select class="mt-5 btn-info border-radius-m p-2" name="selectusertype" id="selectusertype"
        style="margin-left: 320px;margin-right:30px;">
        <option value="" selected>Select User Type</option>
        <option value="admin">admin</option>
        <option value="user">user</option>
    </select>
    <div class="mt-5" style="margin-left: 320px;margin-right:30px;">
        <table class="table-hover" id="usertable">
            <thead style="position: sticky; top: 0;">
                <tr>
                    <td>Action</td>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>User Type</td>
                    <td>Status</td>
                    <td>Last Active Time</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($userdata as $user)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <a type="button" style="font-size:15px;margin:10px;" id="threeDotMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &#8942;
                                </a>
                                <div class="dropdown-menu" aria-labelledby="threeDotMenu">
                                    <a id="editbtn" class="dropdown-item" value="{{ $user->id }}">Edit</a>
                                    <a id="deletebtn" class="dropdown-item" value="{{ $user->id }}">Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->usertype }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->last_active_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                </div>
                <div class="modal-body">

                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
                            rel="stylesheet">
                        <title>Bootstrap Form</title>
                    </head>

                    <body>

                        <div class="container">
                            <form action="{{ route('add_user') }}" method="POST" id="adduserform">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="usertype" class="form-label">User Type</label>
                                    <select class="form-select" id="usertype" name="usertype" required>
                                        <option value="" selected disabled>Select User Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mt-3" style="float:right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        id="closebtn">Close</button>
                                    <button id="user_btn" type="submit" class="btn btn-dark">Add</button>
                                </div>

                            </form>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
                    </body>

                    </html>


                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#usertable').DataTable({
                pagingType: 'full_numbers'
            });



            $(document).on('change', '#selectusertype', function() {
                selectitem = $(this).val();
                if ($(this).prop('selectedIndex') == 0) {
                    table.columns(4)
                        .search('', true, false)
                        .draw();
                } else {
                    table
                        .columns(4)
                        .search(selectitem, true, false)
                        .draw();
                }

            });

            $('#adduser').click(function() {
                $('#exampleModalCenter').modal('show');
                $('#password').removeAttr('disabled');
                $('#adduserform').attr('action', "{{ route('add_user') }}");
                $('#adduserform')[0].reset();
            });


            $('#closebtn').click(function() {
                $('#exampleModalCenter').modal('hide');
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

            $(document).on('click', '#editbtn', function() {
                var editid = $(this).attr('value');
                $('#exampleModalCenter').modal('show');
                $('#adduserform').attr('action', "{{ route('updateuser') }}");
                $.ajax({
                    type: 'POST',
                    url: '/edit',
                    data: "id=" + editid,
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        $('#name').val(response.name);
                        $('#usertype').val(response.usertype);
                        $('#email').val(response.email);
                        $('#password').prop('disabled', true);
                        $('#user_btn').html('Update');

                        var newinput = $('<input>', {
                            type: 'hidden',
                            id: 'user_id',
                            name: 'user_id',
                            value: response.id,
                        });
                        $('#adduserform').append(newinput);
                    },
                    error: function(error) {
                        window.location.href = '/error/' + error.status + '/' +
                            encodeURIComponent(error.statusText);
                    }
                });

            });

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
                            url: '/delete',
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
                                   window.location.reload();
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
