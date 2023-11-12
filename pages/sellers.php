<?php
include "../assets/includes/init.php";

if (!isset($_SESSION['status']))
    header("Location: ./login.php");

$query = "SELECT Users.Username, Users.Address, Users.Business, Users.Number, Users.Email FROM Users INNER JOIN Roles ON Users.RoleId = Roles.Id WHERE RoleName = 'Seller'";
$result = $connection->query($query);
$sellersData = $result->fetchAll();

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
                                All Seller Details
                              </h4>
                            </div>
                          </div>
                          <div class="table-responsive mt-1">
                            <table class="table select-table" style="text-align: center;">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Number</th>
                                  <th>Email</th>
                                  <th>Business</th>
                                  <th>Address</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($sellersData as $seller) { ?>
                                  <tr>
                                    <td>
                                      <h6><?= $seller['Username'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $seller['Number'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $seller['Email'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $seller['Business'] ?></h6>
                                    </td>
                                    <td>
                                      <h6><?= $seller['Address'] ?></h6>
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