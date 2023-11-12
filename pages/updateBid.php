<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Biding WHERE SellerId = $id";
    $result = $connection->query($sql);
    $bidData = $result->fetch(PDO::FETCH_ASSOC);
} else
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
                        <h4 class="card-title">Bid Information</h4>
                        <form class="form-sample" enctype="multipart/form-data">
                            <p class="card-description">
                                Bid Info
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="description" value="<?= $bidData['Description'] ?>" />
                                            <input type="hidden" id="bidId" value="<?= $bidData['Id'] ?>" />
                                            <input type="hidden" id="requirementId" value="<?= $bidData['RequirementId'] ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="price" value="<?= $bidData['Price'] ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-primary mb-2" onclick="updateData()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateData() {
            let requirementId = $("#requirementId").val();
            let data = {
                bidId: $("#bidId").val(),
                description: $("#description").val(),
                price: $("#price").val()
            }

            $.ajax({
                url: "../api/updateBid.php",
                method: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                    window.location.href = './biding.php';
                }
            })
        }
    </script>
    <?php require pathOf('assets/includes/scripts.php'); ?>
    <?php require pathOf('assets/includes/footer.php'); ?>