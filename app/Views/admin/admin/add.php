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
                    <li class="breadcrumb-item"><a href="/admin/admin">Admin</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                            <h5 class="m-0">Add Admin</h5>
                        </div>
                    </div>

                    <form id="formadd">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="namakaryawan">Nama Admin</label>
                                <input type="text" name="namakaryawan" class="form-control" id="namakaryawan" placeholder="Enter nama admin" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary toggle-password" type="button"><i class="fa fa-eye-slash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_jabatan">Jabatan</label>
                                <select name="id_jabatan" id="id_jabatan" class="form-control select2" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($jabatan as $item) : ?>
                                        <option value="<?= esc($item['id_jabatan']) ?>"><?= esc($item['nama_jabatan']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</button>
                            <a href="/admin/admin" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#formadd').submit(function(event) {
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
                url: '/api/admin',
                type: 'POST',
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
                            // Redirect to /admin/admin
                            window.location.href = '/admin/admin';
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

<script>
    $(document).ready(function() {
        $('.toggle-password').on('click', function() {
            const passwordInput = $('#password');
            const passwordFieldType = passwordInput.attr('type');
            const passwordFieldIsPassword = passwordFieldType === 'password';

            passwordInput.attr('type', passwordFieldIsPassword ? 'text' : 'password');
            $(this).find('i').toggleClass('fa-eye-slash fa-eye');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<?= $this->endSection() ?>