<nav class="nav2" id="sideMenu">
  <!-- <div style="display:block;height:10em;"></div> -->
  <a href="#" class="burger3">
    <p>ControlMenu</p>
  </a>
  <ul class="nav__list2">
    <li class="nav__item2">
      <a href="image.php" class="c-purple linkNew2">Image</a>
    </li>
    <li class="nav__item2">
      <a href="video.php" class="c-purple linkNew2">Video</a>
    </li>
    <li class="nav__item2">
      <a href="events.php" class="c-purple linkNew2">Events</a>
    </li>
    <li class="nav__item2">
      <a href="roster.php" class="c-purple linkNew2">Roster</a>
    </li>
    <li class="nav__item2">
      <a href="category.php" class="c-purple linkNew2">Category</a>
    </li>
    <li class="nav__item2">
      <a href="announce.php" class="c-purple linkNew2">Announce-  -ments</a>
    </li>
    <li class="nav__item2">
      <a href="add_user.php" class="c-purple linkNew2">AddUser</a>
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