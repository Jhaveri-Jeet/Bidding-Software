<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

$id = $_GET['id'];
$select = "SELECT Users.Username, Requirement.Price, Requirement.Description, Requirement.Requirement FROM Requirement INNER JOIN Users ON Requirement.BuyerId = Users.Id WHERE Requirement.Id = $id";
$result = $connection->query($select);
$fetch = $result->fetch(PDO::FETCH_ASSOC);

$select = "SELECT Biding.Price, Biding.Id, Biding.Description, Users.Username, Users.Business FROM Biding INNER JOIN Users ON Biding.SellerId = Users.Id WHERE Biding.RequirementId = $id";
$result = $connection->query($select);
$fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

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
                                        <label class="col-sm-3 col-form-label">Name of the Buyer</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?= $fetch["Username"] ?>" disabled />
                                            <input type="hidden" class="form-control" value="<?= $_SESSION["userId"] ?>" id="sellerId" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Requirement</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $fetch["Requirement"] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $fetch["Description"] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" value="<?= $fetch["Price"] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 d-flex flex-column">
                <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">
                                            All Bid
                                        </h4>
                                    </div>
                                    <?php if ($_SESSION['roleName'] == "Seller") { ?>
                                        <div>
                                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">
                                                <i class="mdi mdi-account-plus"></i>
                                                <a href="<?= urlOf('pages/addBid.php?id=').$id ?>" style="color:white; text-decoration:none;">Add New Bid
                                                </a>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="table-responsive mt-1">
                                    <table class="table select-table" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Seller Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Seller Business</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($fetchAll as $requirement) { ?>
                                                <tr>
                                                    <td>
                                                        <h6><?= $requirement['Username'] ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?= $requirement['Description'] ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?= $requirement['Price'] ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?= $requirement['Business'] ?></h6>
                                                    </td>
                                                    <?php if ($_SESSION['username'] == $requirement['Username']) { ?>
                                                        <td>
                                                            <h6><a href="<?= urlOf("pages/updateBid.php?id=") . $_SESSION['userId'] ?>"><i class="mdi mdi-debug-step-out"></i></a></h6>
                                                        </td>
                                                    <?php } ?>
                                                    <?php if ($_SESSION['username'] == $requirement['Username']) { ?>
                                                        <td>
                                                            <h6><a href="<?= urlOf("api/deleteBid.php?id=") . $requirement['Id'] ?>"><i class="mdi mdi-delete"></i></a></h6>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                        alert("Error Occured !");
                }
            })
        }
    </script>
    <?php require pathOf('assets/includes/scripts.php'); ?>
    <?php require pathOf('assets/includes/footer.php'); ?>