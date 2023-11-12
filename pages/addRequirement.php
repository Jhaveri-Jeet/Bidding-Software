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
                        <h4 class="card-title">Requirement Information</h4>
                        <form class="form-sample" enctype="multipart/form-data">
                            <p class="card-description">
                                Requirement Info
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?= $_SESSION["username"] ?>" disabled />
                                            <input type="hidden" class="form-control" value="<?= $_SESSION["userId"] ?>" id="buyerId" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Requirement</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="requirement" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="description" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="price" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <button type="button" class="btn btn-primary mb-2" onclick="sendData()">Submit</button>
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
    <script>
        function sendData() {
            let data = {
                buyerId: $('#buyerId').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                requirement: $('#requirement').val()
            }

            $.ajax({
                url: "../api/insertRequirement.php",
                method: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response == "success")
                        window.location.href = './biding.php';
                    else
                        window.location.href = './addRequirement.php';
                }
            })
        }
    </script>
    <?php require pathOf('assets/includes/scripts.php'); ?>
    <?php require pathOf('assets/includes/footer.php'); ?>