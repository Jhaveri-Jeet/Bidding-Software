<?php
require('../assets/includes/init.php');
require pathOf('assets/includes/styles.php');
?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= urlOf("assets/images/sklogo.png"); ?>" alt="logo" style="display: block;margin-left: auto; margin-right: auto; margin-top:-50px; height: 150px; width: 150px;">
                            </div>
                            <h4>Hello From ! S K Industry</h4>
                            <h6 class="fw-light">Create an Account</h6>
                            <form class="pt-3">
                                <div class="form-group">
                                    <select id="roles" class="form-control form-control-lg" style="color: black;">
                                        <option value="0">Select Your Role</option>
                                        <option value="2">Seller</option>
                                        <option value="3">Buyer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" id="number" placeholder="Number">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="business" placeholder="Business">
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="addUser()">Create</button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Have an account? <a href="<?= urlOf('pages/login.php') ?>" class="text-primary">Log In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= require pathOf('assets/includes/scripts.php'); ?>
    <script>
        function addUser() {
            let data = {
                roleId: $("#roles").val(),
                name: $("#name").val(),
                password: $("#password").val(),
                number: $("#number").val(),
                email: $("#email").val(),
                address: $("#address").val(),
                business: $("#business").val()
            };

            $.post("../api/addUser.php", data, function(response) {
                window.location.replace("./login.php");
            });

            $("#usersOptions").show();
        }
    </script>