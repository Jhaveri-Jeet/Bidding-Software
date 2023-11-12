<?php
require('../assets/includes/init.php');

$query = "SELECT * FROM roles";
$result = $connection->query($query);
$rolesData = $result->fetchAll();

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
              <h6 class="fw-light">Sign in to continue.</h6>
              <form class="pt-3">
                <div class="form-group">
                  <select id="roles" class="form-control form-control-lg" onchange="displayUsers()" style="color: black;">
                    <option>Select Your Role</option>
                    <?php foreach ($rolesData as $role) { ?>
                      <option value="<?= $role["Id"] ?>"><?= $role["RoleName"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group" id="usersOptions" style="display: none;">
                  <select id="users" class="form-control form-control-lg" style="color: black;">
                  </select>
                </div>
                <div class="form-group passwordAndBtn" style="display: none;">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="mt-3 passwordAndBtn" style="display: none;">
                  <button type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="checkUser()">LOG IN</button>
                </div>
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="<?= urlOf('pages/register.php') ?>" class="text-primary">Create</a>
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
    function displayUsers() {
      let roleId = $("#roles").val();

      $.post("../api/displayUsers.php", {
        roleId: roleId
      }, function(response) {
        console.log(response);
        let options = ''
        for (let i = 0; i < response.length; i++) {
          options += '<option value="' + response[i]["Id"] + '">' + response[i]["Username"] + '</option>';
        }
        $("#users").html(options);
        $("#usersOptions").show();
        $(".passwordAndBtn").show();
      });
    }

    function checkUser() {
      let data = {
        userId: $("#users").val(),
        password: $("#password").val()
      }

      $.post("../api/checkUser.php", data, function(response) {
        console.log(response);
        if (response == "success")
          window.location.replace("../index.php");
        else
          window.location.replace("./login.php");
      })
    }
  </script>