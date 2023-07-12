<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'includes/head.php' ?>
</head>

<body onafterprint="hideLogo()">

  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>

  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

      <?php include 'includes/header.php' ?>
      <?php include 'includes/chatSidebar.php' ?>
      <?php include 'includes/showChat_inner.php' ?>

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">

          <?php include 'includes/sidebar.php' ?>
          
            <!-- Start Content -->
                <?php 
                include 'content.php';
                
                $pageName = $_GET['p'];
                redirectPage($pageName);
                ?>

          <div id="styleSelector">
          </div>

        </div>
      </div>
      <?php include 'includes/footer.php' ?>
    </div>
  </div>



  <!--[if lt IE 10]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade
              <br/>to any of the following web browsers to access this website.
          </p>
          <div class="iew-container">
              <ul class="iew-download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="./files/assets/images/browser/chrome.png" alt="Chrome">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="./files/assets/images/browser/firefox.png" alt="Firefox">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="./files/assets/images/browser/opera.png" alt="Opera">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="./files/assets/images/browser/safari.png" alt="Safari">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="./files/assets/images/browser/ie.png" alt="">
                          <div>IE (9 & above)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
  <![endif]-->

  <!-- <script src="../files/assets/jquery/jquery.min.js"></script> -->

</html>