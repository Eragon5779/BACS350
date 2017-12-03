<?php
  require_once('includes/config.php');
  if(!$user->is_logged_in()){ header('Location: index.php'); exit(); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Profile Page</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="dash/css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php">Artist'sAlley</a></div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Current Activity <span class="sr-only">(current)</span></a> </li>
        <li><a href="#">Home</a> </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Feeling Lucky?</a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Favorite Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Category 1</a> </li>
            <li><a href="#">Category 2</a> </li>
            <li><a href="#">Categroy 3</a> </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">More Categories</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- HEADER -->
<header>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <?php $firstName = $_SESSION['firstName']; echo "<h1 class=\"text-center\">$firstName's Profile</h1>"; ?>
          <p class="text-center">Welcome to your profile page! Here you can edit your user preferences, and see all current bidding activity you are a part of.</p>
          <p>&nbsp;</p>
          <p class="text-center"><a class="btn btn-primary btn-lg" href="index.php" role="button">Back to Home</a> </p>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- / HEADER --> 

<!--  SECTION-1 -->
<section>
  <div class="row">
    <div class="col-lg-12 page-header text-center">
      <h2>Dashboard</h2>
    </div>
  </div>
<div class="container ">
  <div class="row">
      <div class="col-lg-4 col-sm-12 text-center"> <img alt="current bids" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://iaa-auctions.com/wp-content/uploads/2016/09/BuyingServices_OnsiteBidPaddle_Icon.svg" data-holder-rendered="true">
        <h3>Current Bids</h3>
        <p>View current bids you are participating in that are still ongoing, as well as history of past bids.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img alt="bookmarks" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="http://www.endlessicons.com/wp-content/uploads/2014/03/bookmark-icon-3.png" data-holder-rendered="true">
        <h3>Bookmarked</h3>
        <p>Art listing's you have bookmarked for later viewing.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img alt="notifications" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://image.freepik.com/free-icon/notification_318-41075.jpg" data-holder-rendered="true">
        <h3>Notification Settings</h3>
        <p>Notification Settings for the site, and any bids you are currently active in.</p>
      </div>
      <?php $firstName = $_SESSION['firstName']; echo '<div class="col-lg-4 col-sm-12 text-center"><img alt="user icon" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="/media/' . $firstName . '.jpg" data-holder-rendered="true">';?>
        <h3>Profile Settings</h3>
        <p>Profile Settings to modify your public presence on the site.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img alt="security settings" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://image.freepik.com/free-icon/security-symbol_318-31394.jpg" data-holder-rendered="true">
        <h3>Security Settings</h3>
        <p>Security settings for changing your password, deleting your account, or reporting site misuse.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img alt="settings" class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="https://image.freepik.com/free-icon/gear-interface-symbol-for-configuration_318-61466.jpg" data-holder-rendered="true">
        <h3>UI Settings</h3>
        <p>Change the site's look to suit your preference.</p>
      </div>
  </div>
</div>
<div class="jumbotron">
    <div class="container">
    </div>
  </div>
  
  <!-- /container -->
  
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © MyWebsite. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- / FOOTER --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
