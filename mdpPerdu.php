<?php
include_once("phpclass/head.php");
include_once("phpclass/sql_database.php");
$database = sql_database::log_database();
?>
<link rel="stylesheet" href="ressources/styleMDPerdu.css">
<body>
<?php
include_once('phpclass/menu.php');
?>
<div class="container">

    <?php
    require_once('phpclass/mdpLa.php');
    echo mdpLa::getHTML();
    ?>
</div>

<?php
include_once('phpclass/foot.php');
?>
</body>
</html>