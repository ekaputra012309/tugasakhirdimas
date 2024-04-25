<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <img src="/favicon.ico" class="img-circle elevation-2" alt="User Image"> -->
                <?= session('namakaryawan') ?> &nbsp; <i class="fas fa-user-circle mr-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-lock mr-2"></i> Change Password
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-edit mr-2"></i> View Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" id="logoutBtn">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>