<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E Presensi | Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url ?>resources/img/logo/new_logo/logo-login.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="<?= base_url ?>resources/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('<?= base_url ?>resources/images/bg-login-1.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100 justify-content-center">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto col-sm-12 mt-3">
                            <div class="card shadow-lg" style="border-radius: 10px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <img class="img-fluid" alt="" src="<?= base_url ?>resources/img/logo/new_logo/logo.png" width="190">
                                    </div>
                                    <h2 class="font-weight-bold text-center mb-2">LOGIN PAGE</h2>
                                    <form action="login" method="post" method="POST">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="userName" name="username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center">
                                                <button class="btn w-100 text-white" style="background-color: #48CD18;" type="submit" name="submit">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php

                                    use Utils\Flasher;

                                    Flasher::flash(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-start">
                    <!-- <div class="card shadow-lg" style="border-radius: 5px;"> -->
                    <!-- <div class="card-body" style="margin: -15px"> -->
                    <span class="text-default">© 2022 NekoID</span>
                    <!-- </div>
                        </div>  -->
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="<?= base_url ?>resources/js/vendors.min.js"></script>

    <!-- notif -->
    <script src="<?= base_url ?>resources/js/jquery.min.js"></script>
    <script src="<?= base_url ?>resources/js/bootstrap.bundle.min.js"></script>
    <!-- page js -->

    <!-- Core JS -->
    <script src="<?= base_url ?>resources/js/app.min.js"></script>

</body>

</html>