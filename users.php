<?php
session_start();
require_once("phpclass/sql_database.php");
$database = sql_database::log_database();
if (!isset($_SESSION['id'])) {
  header("location: index.php");

}
include_once "header.php";
?>

<body>
<?php
include_once "phpclass/menu.php"
?>
<div class="wrapper">
  <section class="users">
    <header>
      <div class="content">
        <?php
        $sql = mysqli_query($database, "SELECT photo, nom, prenom, id, status FROM etudiant WHERE id = {$_SESSION['id']}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <img src="ressources/profil_image/<?php echo $row['photo']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['prenom'] . " " . $row['nom'] ?></span>
          <p><?php echo $row['status']; ?></p>

        </div>
      </div>
        <a style="text-decoration: none; color: black" href="add.php"><i class="fa-solid fa-plus fa-2xl"></i></a>
    </header>
      <div class="search">
          <span class="text">Liste des Conversations</span>
          <a><i class="bi bi-plus-lg icon-black"></i></a>
          <input type="text" style="display: none;" placeholder="Enter name to search...">
          <button style="display: none;"><i class="fas fa-search"></i></button>
      </div>
      <div></div>
      <div class="users-list">

      </div>
  </section>
</div>
<?php
include_once "phpclass/foot.php";
?>
<script src="javascript/users.js"></script>

</body>
</html>
