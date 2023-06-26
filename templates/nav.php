<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">FF Spelen</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    $currentURL = $_SERVER['REQUEST_URI'];
    $currentPage = basename($currentURL);
    ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php
          if ($currentPage == "index.php") {
            button("Home", "index.php", "active");
          } else {
            button("Home", "index.php");
          } ?>
        </li>
        <li class="nav-item dropdown">
          <a class="button-33 dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
          <div class="dropdown-menu animate__animated animate__fadeIn">
            <?php
            $sql = "SELECT DISTINCT category FROM games";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $category) {
              echo "<a class='dropdown-item' href='index.php?name=" . $category['category'] . "'>" . $category['category'] . "</a>";
            } ?>
          </div>
        </li>
        <li class="nav-item">
          <?php
          if ($currentPage == "contact.php") {
            button("Contact", "contact.php", "active");
          } else {
            button("Contact", "contact.php");
          } ?>
        </li>
        <?php
        if (isset($_SESSION['user'])) {
          if ($currentPage == "adminpanel.php") { ?>
            <li class="nav-item">
              <?php button("Adminpanel", "adminpanel.php", "active"); ?>
            </li>
          <?php } else { ?>
            <li class="nav-item">
            <?php button("Adminpanel", "adminpanel.php"); ?>
            </li>
          <?php } ?>
        <?php } ?>
        <?php
        if (isset($_SESSION['user'])) { ?>
          <li class="nav-item">
            <?php
            button("Logout", "actions/logout.php"); ?>
          </li> <?php
              } else {
                if ($currentPage == "adminpanel.php") { ?>
            <li class="nav-item">
              <?php
                  button("Login", "login.php", "active"); ?>
            </li> <?php
                } else { ?>
            <li class="nav-item">
              <?php button("Login", "login.php"); ?>
            </li> <?php
                }
              }
                  ?>
      </ul>
    </div>
  </div>
</nav>