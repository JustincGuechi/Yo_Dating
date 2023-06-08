<?php
include_once("phpclass/head.php");
include_once("phpclass/sql_database.php");
$database = sql_database::log_database();
?>
<link rel="stylesheet" href="ressources/stylemailRecuperation.css">
<body>
<?php
require_once('phpclass/menu.php');
?>
<div class="container">
    <?php
    require_once('phpclass/mailRecup.php');
    echo mailRecup::getHTML($database);
    ?>
</div>

<?php
require_once('phpclass/foot.php');
?>
</body>
</html>