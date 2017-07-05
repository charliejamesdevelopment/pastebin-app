<nav class="navbar navbar-toggleable-md navbar-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <img src="<?php echo $logo_url ?>" width="30" height="30" class="d-inline-block align-top" alt="">
  <a class="navbar-brand" href="#">Pastebin</a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item<?php if($title === "Home") { echo " active"; } ?>">
        <a class="nav-link" href="<?php echo $url ?>app/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item<?php if($title === "All Pastes") { echo " active"; } ?>">
        <a class="nav-link" href="<?php echo $url ?>app/all_pastes.php">All Pastes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $url ?>app/logout.php">Logout</a>
      </li>
    </ul>
    <span class="navbar-text">
      Welcome, <span class="user"><?php if(isset($_SESSION["username"])) { echo $_SESSION["username"]; } else { echo "Guest"; } ?></span>
    </span>
  </div>
</nav>
