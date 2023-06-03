<?php
$WEBSITE = "Yo Dating";
$OWNER = "Guéchi - Weber - Legendre - Vivier";
$YEAR = date("Y");
require_once("phpclass/sql_database.php");
$database = sql_database::log_database();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?php echo $WEBSITE; ?></title>
  <link rel="stylesheet" href="ressources/stylesheet.css">
  <link rel="icon" href="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
