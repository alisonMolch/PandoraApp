<nav class="nav" id="sideMenu">
  <div class="burger" style="visibility:hidden">
    <div class="burger__patty"></div>
  </div>
  <ul class="nav__list">
    <li class="nav__item">
      <a href="image.php" class="nav__link c-purple linkNew">Image</a>
    </li>
    <li class="nav__item">
      <a href="video.php" class="nav__link c-purple linkNew">Video</a>
    </li>
    <li class="nav__item">
      <a href="events.php" class="nav__link c-purple linkNew">Events</a>
    </li>
    <li class="nav__item">
      <a href="roster.php" class="nav__link c-purple linkNew">Roster</a>
    </li>
    <li class="nav__item">
      <a href="category.php" class="nav__link c-purple linkNew">Category</a>
    </li>
    <li class="nav__item">
      <a href="announce.php" class="nav__link c-purple linkNew">Announce-  -ments</a>
    </li>
    <li class="nav__item">
      <a href="add_user.php" class="nav__link c-purple linkNew">AddUser</a>
    </li>
  </ul>
  <script>
    var current = function(){
        $('a').each(function() {
          var lock = "" + window.location.href;
          if (lock.indexOf('?') >= 0) {
            lock = lock.slice(0,lock.indexOf('?'));
          }
          if ((""+$(this).prop('href')) == lock) {
              $(this).addClass('currentPage');
          }
        });
    };
    window.addEventListener('load', current, false);
  </script>
</nav>