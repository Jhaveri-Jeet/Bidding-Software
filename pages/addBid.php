<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

$id = $_GET['id'];
$select = "SELECT Users.Username, Requirement.Price, Requirement.Description, Requirement.Requirement FROM Requirement INNER JOIN Users ON Requirement.BuyerId = Users.Id WHERE Requirement.Id = $id";
$result = $connection->query($select);
$fetch = $result->fetch(PDO::FETCH_ASSOC);

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
                                        <label class="col-sm-3 col-form-label">Seller Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?= $_SESSION["username"] ?>" disabled />
                                            <input type="hidden" class="form-control" value="<?= $_SESSION["userId"] ?>" id="sellerId" />
                                            <input type="hidden" class="form-control" value="<?= $id ?>" id="requirementId" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Buyer Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $fetch['Username'] ?>" disabled />
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
                                            <button type="button" class="btn btn-primary mb-2" onclick="sendData()">Add Bid</button>
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
            let requirementId = $('#requirementId').val();
            let data = {
                sellerId: $('#sellerId').val(),
                requirementId: $('#requirementId').val(),
                description: $('#description').val(),
                price: $('#price').val(),
            }

            $.ajax({
                url: "../api/insertBid.php",
                method: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response == "success")
                        window.location.href = './viewBid.php?id='.requirementId;
                    else
                        alert("Error Occured !");
                }
            })
        }
    </script>
    <?php require pathOf('assets/includes/scripts.php'); ?>
    <?php require pathOf('assets/includes/footer.php'); ?>