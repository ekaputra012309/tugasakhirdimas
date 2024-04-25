<?= $this->extend('admin/template/layout') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Table admin</h5>
                            <a href="/admin/admin/add" type="button" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getData();

        function getData() {
            $.ajax({
                url: "/api/admin",
                type: "GET",
                success: function(response) {
                    if ($.fn.DataTable.isDataTable('#example')) {
                        $('#example').DataTable().destroy();
                    }

                    // Initialize DataTable with new data
                    var table = $('#example').DataTable({
                        data: response,
                        columns: [{
                                data: null,
                                render: function(data, type, row) {
                                    var id = row.id;
                                    return '<button type="button" class="btn btn-info btn-sm edit-btn" data-id="' + id + '"><i class="fas fa-pencil-alt"></i> Edit</button> ' +
                                        '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="' + id + '"><i class="fas fa-trash"></i> Delete</button>';
                                }
                            },
                            {
                                data: 'namakaryawan'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'username'
                            },
                            {
                                data: 'nama_jabatan'
                            },
                        ],
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        buttons: ["print", "colvis"]
                    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Edit button click event
        $('#example').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var encodedId = btoa(id);
            // alert('Edit ID: ' + encodedId);
            window.location.href = '/admin/admin/edit?id=' + encodedId; // Pass the encoded ID as a parameter

        });

        // Delete button click event
        $('#example').on('click', '.delete-btn', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, proceed with delete operation
                    $.ajax({
                        url: '/api/admin/' + id, // Specify the delete endpoint with the ID
                        type: 'DELETE',
                        success: function(response) {
                            // Handle success response
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    getData();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(error);
                            // Optionally, show an error message to the user
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>