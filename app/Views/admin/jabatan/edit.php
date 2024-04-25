<?= $this->extend('admin/template/layout') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jabatan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/jabatan">Jabatan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                            <h5 class="m-0">Edit Jabatan</h5>
                            <a href="/admin/jabatan/edit" type="button" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Edit</a>
                        </div>
                    </div>

                    <form id="formupdate">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input type="hidden" name="id_jabatan" class="form-control" id="id_jabatan">
                                <input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan" placeholder="Enter nama jabatan" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                            <a href="/admin/jabatan" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getDataby();

        function getDataby() {
            var id = '<?= $id ?>';
            $.ajax({
                url: '/api/jabatan/' + id,
                type: 'GET',
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    $('#id_jabatan').val(response.id_jabatan);
                    $('#nama_jabatan').val(response.nama_jabatan);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    // Optionally, show an error message to the user
                }
            });
        }

        $('#formupdate').submit(function(event) {
            var id = '<?= $id ?>';
            // Prevent the default form submission
            event.preventDefault();
            // Serialize form data into an array of objects
            var formDataArray = $(this).serializeArray();
            // Convert the array of objects into a JSON object
            var jsonData = {};
            $.each(formDataArray, function(index, obj) {
                jsonData[obj.name] = obj.value;
            });
            // Send AJAX request
            $.ajax({
                url: '/api/jabatan/' + id,
                type: 'PUT',
                data: JSON.stringify(jsonData),
                contentType: 'application/json',
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Show a success message to the user with the response message
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            // Redirect to /admin/jabatan
                            window.location.href = '/admin/jabatan';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    // Optionally, show an error message to the user
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>