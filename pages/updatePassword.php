<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

require pathOf('assets/includes/styles.php');
require pathOf('assets/includes/header.php');
require pathOf('assets/includes/navbar.php');
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Password Change</h4>
                        <form class="form-sample" enctype="multipart/form-data">
                            <p class="card-description">
                                Change user password
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="oldPassword" onchange="checkOldPassword()" autofocus />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="newPassword" style="display: none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <button type="button" class="btn btn-primary mb-2" onclick="updatePassword()">Change Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require pathOf('assets/includes/footer.php'); ?>
    <?php require pathOf('assets/includes/scripts.php'); ?>
    <script>
        function checkOldPassword() {
            let data = {
                password: $("#oldPassword").val()
            }
            $.post("../api/checkOldPassword.php", data, function(response) {
                console.log(response);
                if (response == 'success') {
                    $("#newPassword").show();
                    $("#newPassword").focus();
                } else {
                    alert("Old Password is incorrect");
                    $("#oldPassword").val("");
                    $("#oldPassword").focus();
                }
            })
        }

        function updatePassword() {
            let oldPassword = $("#oldPassword").val();
            let newPassword = $("#newPassword").val();
            let data = {
                password: $("#newPassword").val()
            }
            if (oldPassword == '' || newPassword == '')
                alert("Old Password or New Password is blank");
            else {
                $.post("../api/updatePassword.php", data, function(response) {
                    alert("Password Updated !");
                    $("#oldPassword").val("");
                    $("#newPassword").val("");
                    $("#oldPassword").focus();
                })
            }
        }
    </script>