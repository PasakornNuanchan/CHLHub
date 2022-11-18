<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
</head>
<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <!--Sidebar Start-->
    <?php include 'include/sidebarmain.php'; ?>
    <!--Sidebar End-->

    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <?php include 'include/nevbarmain.php'; ?>
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <!-- MAIN BODY START -->

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          ALL
          <tr>
              <th>PART</th>
              <th>Price</th>
              <th>Current</th>
            </tr>
            <tr>
              <td><input type="checkbox" name="" id="">Apply to all</td>
              <td><input type="text" name="" id=""></td>
              <td><input type="text" name="" id=""></td>
            </tr>
            <tr>
              <th>PART</th>
              <th>Price</th>
              <th>Current</th>
            </tr>
            <tr>
              <td><input type="checkbox" name="" id="">T1</td>
              <td><input type="text" name="" id=""></td>
              <td><input type="text" name="" id=""></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="" id="">T2</td>
              <td><input type="text" name="" id=""></td>
              <td><input type="text" name="" id=""></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="" id="">T3</td>
              <td><input type="text" name="" id=""></td>
              <td><input type="text" name="" id=""></td>
            </tr>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>






















        <!-- MAIN BODY END -->
        </div>
        <!-- Footer Section Start -->
        <?php include 'include/footermain.php'; ?>
        <!-- Footer Section End -->
    </main>

    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>

<script>
</script>