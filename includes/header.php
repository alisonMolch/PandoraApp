<!--   <div class="sidemenu">
    <nav class="left">
      <a class="page-scroll" href="#about">About</a>
      <a class="page-scroll" href="#contact">Contact</a>
    </nav>
    <nav class="right">
      <a href="media.php">Media</a>
      <a href="roster.php">Team Roster</a>
      <a href="event.php">Events</a>
    </nav>
  </div> -->

<!-- <nav class="navbar navbar-light navbar-fixed-top bg-faded">
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="media.php">Media</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="roster.php">Team Roster</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="event.php">Events</a>
    </li>
  </ul>
</nav> -->

<!-- <nav class="navbar navbar-light navbar-fixed-top bg-faded">
  <a class="nav-link" href="index.php">Home</a>
  <a class="nav-link" href="media.php">Media</a>
  <a class="nav-link" href="roster.php">Team Roster</a>
  <a class="nav-link" href="events.php">Events</a>
</nav> -->




<nav class="nav">
  <div class="burger">
    <div class="burger__patty"></div>
  </div>

  <ul class="nav__list">
    <li class="nav__item">
      <a href="index.php" class="nav__link c-purple">Home</a>
    </li>
    <li class="nav__item">
      <a href="media.php" class="nav__link c-purple">Media</a>
    </li>
    <li class="nav__item">
      <a href="roster.php" class="nav__link c-purple">Roster</a>
    </li>
    <li class="nav__item">
      <a href="events.php" class="nav__link c-purple">Events</a>
    </li>
    <li class="nav__item">
      <a href="login.php" class="nav__link c-purple">Login</a>
    </li>
    <li class="nav__item">
      <a href="signup.php" class="nav__link c-purple">Sign up</a>
    </li>
<?php
  if ( isset( $_SESSION[ 'logged_user' ] ) &&  isset( $_SESSION[ 'permission' ] ) && $_SESSION[ 'permission' ] == 5 ) { 
      print("<li class='nav__item'><a href='control.php' class='nav__link c-purple'>Control</a></li>");
  } 
?>
  </ul>
</nav>
