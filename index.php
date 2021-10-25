<?php include('config.php'); ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from radixtouch.in/templates/admin/hotel/source/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Jan 2020 12:38:06 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>EFL Myanmar | Login</title>
    <!-- icons -->
    <link href="<?php echo roothtml.'lib/assets/plugins/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet"
        href="<?php echo roothtml.'lib/assets/plugins/iconic/css/material-design-iconic-font.min.css' ?>">
    <!-- bootstrap -->
    <link href="<?php echo roothtml.'lib/assets/plugins/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet"
        type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="<?php echo roothtml.'lib/assets/css/pages/extra_pages.css' ?>">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo roothtml.'lib/images/ums.jpg' ?>" />
    <!-- Sweet Alarm -->
    <link href="<?php echo roothtml.'lib/sweet/sweetalert.css' ?>" rel="stylesheet" />
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.js' ?>"></script>
    <style>
    .loader {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.7;
        -moz-opacity: 0.8;
    }

    .center-load {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: black;
        border-radius: 10px;
        filter: 1;
        -moz-opacity: 1;
    }

    .center-load img {
        height: 128px;
        width: 128px;
    }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100 page-background">
            <div class="wrap-login100">
                <form id="frm" class="login100-form validate-form">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-home"></i>
                    </span>
                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" name="username" placeholder="Username" value="admin">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password" value="1">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>
                    <div class="container-login100-form-btn">
                        <button id="btnlogin" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <div class="text-center p-t-90">
                        <a class="txt1" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="loader" style="display:none;">
        <div class="center-load">
            <img src="<?php echo roothtml.'lib/images/ajax-loader1.gif'; ?>" />
        </div>
    </div>


    <!-- start js include path -->
    <script src="<?php echo roothtml.'lib/assets/plugins/jquery/jquery.min.js' ?>"></script>
    <!-- bootstrap -->
    <script src="<?php echo roothtml.'lib/assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/pages/extra_pages/login.js' ?>"></script>
    <!-- end js include path -->

    <script>
    $(document).ready(function() {

        $(document).on("click", "#btnlogin", function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?php echo roothtml.'index_action.php' ?>",
                data: $("#frm").serialize() + "&action=login",
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(data) {
                 
                    $(".loader").hide();
                    if (data == 1) {
                        swal("Successful!", "Login Successful.", "success");
                        location.href ="<?php echo roothtml.'home/home.php' ?>";
                    } else {
                        swal("Error!", "User Name or Password incorrect.", "error");
                    }
                }
            });
        });


    });
    </script>


</body>


<!-- Mirrored from radixtouch.in/templates/admin/hotel/source/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Jan 2020 12:38:06 GMT -->

</html>