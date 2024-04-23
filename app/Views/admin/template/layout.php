<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?= $this->include('admin/template/header'); ?>

        <?= $this->include('admin/template/sidebar'); ?>

        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

        <?= $this->include('admin/template/footer'); ?>
    </div>

    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function() {
                // Make an AJAX request to logout endpoint
                $.ajax({
                    url: '/authadmin/logout',
                    type: 'GET',
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = '/admin/login';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Logout failed');
                    }
                });
            });
        });
    </script>
</body>

</html>