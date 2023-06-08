<?php
ob_start();

session_start();
require_once("phpclass/sql_database.php");
$database = sql_database::log_database();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}

include_once "header.php";
?>

<body>
<?php include_once "phpclass/menu.php"; ?>
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
            <a style="text-decoration: none; color: black" href="users.php"><i class="fa-solid fa-xmark fa-2xl"></i></a>
        </header>
        <div class="search">
            <span class="text">Liste des Conversations</span>
            <a><i class="bi bi-plus-lg icon-black"></i></a>
            <input type="text" style="display: none;" placeholder="Enter name to search...">
            <button style="display: none;"><i class="fas fa-search"></i></button>
        </div>
        <div></div>
        <div class="users-list">
            <form method="post">
                <?php
                $sql = mysqli_query($database, "SELECT id, prenom, photo
                    FROM etudiant
                    WHERE id IN (
                        SELECT etudiantRecepteur
                        FROM amis
                        WHERE etudiantEmeteur = {$_SESSION['id']} AND statut = 'accept'
                    )
                    OR id IN (
                        SELECT etudiantEmeteur
                        FROM amis
                        WHERE etudiantRecepteur = {$_SESSION['id']} AND statut = 'accept'
                    )
                    AND id != '{$_SESSION['id']}';");
                while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                    <a>
                        <div class="content">
                            <input type="checkbox" name="id[]" value="<?php echo $row['id'] ?>">
                            <img src="ressources/profil_image/<?php echo $row['photo'] ?>" style="margin-left: 10px"
                                 alt="">
                            <div class="details">
                                <span><?php echo $row['prenom'] ?></span>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <input type="submit" name="newConv" value="Crée une conversation">
            </form>
        </div>
    </section>
</div>
<?php
include_once("phpclass/foot.php");
?>
</body>

<?php
if (isset($_POST['newConv'])) {
    if (isset($_POST['id'])) {
        $n = count($_POST['id']);
        $name = $_SESSION['prenom'] . " ";
        for ($i = 0; $i < $n; $i++) {
            $sql2 = mysqli_query($database, "SELECT id, prenom
                FROM etudiant
                WHERE id='{$_POST['id'][$i]}';");
            $conv[] = mysqli_fetch_assoc($sql2);
            $name = $name . $conv[$i]['prenom'] . " ";
        }
        $sql6 = mysqli_query($database, "SELECT count(*) as n from conversation where nom = '$name';");
        if (1 != mysqli_fetch_assoc($sql6)['n']) {
            $sql3 = mysqli_query($database, "INSERT INTO conversation (nom, image) values ('$name', 'profil-vide.png');");
            $idConv = mysqli_insert_id($database);
            for ($i = 0; $i < $n; $i++) {
                $sql4 = mysqli_query($database, "INSERT INTO membre values ({$conv[$i]['id']},'$idConv');");
            }
            $sql5 = mysqli_query($database, "INSERT INTO membre values ({$_SESSION['id']},'$idConv');");
            header('Location: users.php');
            exit();
        }
    }
}

ob_end_flush();
?>
