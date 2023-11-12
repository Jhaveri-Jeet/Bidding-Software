<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

$query = "SELECT Requirement.Price, Requirement.Requirement, Requirement.Description, Users.Username, Users.Business FROM requirement INNER JOIN Users ON Requirement.BuyerId = Users.Id WHERE Requirement.Status = 'Fulfilled' ORDER BY Users.Id DESC";
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
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
              <div class="row">
                <div class="col-lg-12 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">
                                All Completed Requirements
                              </h4>
                            </div>
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

    <?php require pathOf('assets/includes/scripts.php'); ?>
    <?php require pathOf('assets/includes/footer.php'); ?>