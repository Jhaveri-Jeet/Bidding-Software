<?php
include "./assets/includes/init.php";

if (!isset($_SESSION['status']))
  header("Location: ./pages/login.php");

$query = "SELECT Requirement.Id, Requirement.Price, Requirement.Requirement, Requirement.Description, Users.Username, Users.Business FROM requirement INNER JOIN Users ON Requirement.BuyerId = Users.Id WHERE Requirement.Status = 'NotFulfilled'";
$result = $connection->query($query);
$requirementData = $result->fetchAll();

require pathOf('assets/includes/styles.php');
require pathOf('assets/includes/header.php');
require pathOf('assets/includes/navbar.php');
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
              </li>
            </ul>
          </div>
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                      <p class="statistics-title">Total Buyer</p>
                      <h3 class="rate-percentage" style="text-align: center;" id="totalBuyer"></h3>
                    </div>
                    <div>
                      <p class="statistics-title">Total Seller</p>
                      <h3 class="rate-percentage" style="text-align: center;" id="totalSeller"></h3>
                    </div>
                    <div>
                      <p class="statistics-title">Pending Biding</p>
                      <h3 class="rate-percentage" style="text-align: center;" id="pendingBiding"></h3>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Completed Biding</p>
                      <h3 class="rate-percentage" style="text-align: center;" id="completedBiding"></h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">
                                Biding
                              </h4>
                            </div>
                            <?php if ($_SESSION['roleName'] == "Buyer") { ?>
                              <div>
                                <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">
                                  <i class="mdi mdi-account-plus"></i>
                                  <a href="<?= urlOf('pages/addRequirement.php') ?>" style="color:white; text-decoration:none;">Add New Requirement
                                  </a>
                                </button>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="table-responsive mt-1">
                            <table class="table select-table" style="text-align: center;">
                              <thead>
                                <tr>
                                  <th>Requirement</th>
                                  <th>Description</th>
                                  <th>Price</th>
                                  <th>Buyer Name</th>
                                  <th>Buyer Business</th>
                                  <th colspan="4">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($requirementData as $requirement) { ?>
                                  <tr>
                                    <td>
                                      <h6><?= $requirement['Requirement'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $requirement['Description'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $requirement['Price'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $requirement['Username'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $requirement['Business'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><a href="<?= urlOf("pages/viewBid.php?id=") . $requirement['Id'] ?>"><i class="mdi mdi-gavel"></i></a></h6>
                                    </td>
                                    <?php if ($_SESSION['username'] == $requirement['Username']) { ?>
                                      <td>
                                        <h6><a href="<?= urlOf("api/completeRequirement.php?id=") . $requirement['Id'] ?>"><i class="mdi mdi-checkbox-multiple-marked-circle-outline"></i></a></h6>
                                      </td>
                                    <?php } ?>
                                    <?php if ($_SESSION['username'] == $requirement['Username']) { ?>
                                      <td>
                                        <h6><a href="<?= urlOf("pages/updateRequirement.php?id=") . $requirement['Id'] ?>"><i class="mdi mdi-debug-step-out"></i></a></h6>
                                      </td>
                                    <?php } ?>
                                    <?php if ($_SESSION['username'] == $requirement['Username']) { ?>
                                      <td>
                                        <h6><a href="<?= urlOf("api/deleteRequirement.php?id=") . $requirement['Id'] ?>"><i class="mdi mdi-delete"></i></a></h6>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require pathOf('assets/includes/footer.php'); ?>
  <?php require pathOf('assets/includes/scripts.php'); ?>
  <script>
    $(init);

    function init() {
      fetchTotalBuyerCount();
      fetchTotalSellerCount();
      fetchTotalPendingBidingCount();
      fetchTotalCompletedBidingCount();
    }

    function fetchTotalBuyerCount() {
      $.post("./api/fetchTotalBuyerCount.php", function(data) {
        $("#totalBuyer").text(data[0]['totalBuyer']);
      });
    }

    function fetchTotalSellerCount() {
      $.post("./api/fetchTotalSellerCount.php", function(data) {
        $("#totalSeller").text(data[0]['totalSeller']);
      });
    }

    function fetchTotalPendingBidingCount() {
      $.post("./api/fetchTotalPendingBidingCount.php", function(data) {
        $("#pendingBiding").text(data[0]['pendingBiding']);
      });
    }

    function fetchTotalCompletedBidingCount() {
      $.post("./api/fetchTotalCompletedBidingCount.php", function(data) {
        $("#completedBiding").text(data[0]['completedBiding']);
      });
    }
  </script>