<?php
require_once('phpclass/head.php');
?>
<body>
<link rel="stylesheet" href="ressources/logsign_style.css">

<?php
require_once('phpclass/menu.php');
?>
<div class="titre">
    <?php
    if (!isset($_SESSION['id'])) {
        ?>
        <p>
            Bienvenue sur
            <?php echo $WEBSITE;
            ?>
        </p>
        <?php
    }
    ?>

</div>
<div class="container">
    <?php
    if (!isset($_SESSION['id'])) {
        require_once('phpclass/login.php');
        require_once('phpclass/signup.php');
        require_once('phpclass/submit.php');
    }
    ?>
</div>
<?php
require_once('phpclass/foot.php');
?>
</body>
</html>