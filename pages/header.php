<nav>
  <div class="nav-wrapper">
    <a href="index.php" class="brand-logo left"><img class="logo" src="images/logo.svg"><span class="logo">WeatherCollector</span></a>
    <a href="" class="button-collapse right"><i class="material-icons">menu</i></a>
    
    <ul id="nav" class="hide-on-med-and-down right">
      <li><a <?php if($page == "" || $page == "index"){ echo 'class="active"'; } ?> href="index.php">Home</a></li>
      <li><a <?php if($page == "instructable"){ echo 'class="active"'; } ?> href="instructable.php">Instructable</a></li>
      <li><a <?php if($page == "about"){ echo 'class="active"'; } ?> href="about.php">About</a></li>
    </ul>
    <ul class="mobile-nav right">
      <li><a class="close-collapse" href=""><i class="material-icons">close</i></a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="instructable.php">Instructable</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </div>
</nav>