<?php
session_start();
require_once("phpclass/sql_database.php");
$database = sql_database::log_database();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
if (isset($_GET['conv'])) {
    $convId = $_GET['conv'];
    $sql = "SELECT idMembre FROM membre WHERE idConversation = $convId";
    $result = $database->query($sql);

// Vérification de l'id dans $_SESSION['id']
    $sessionId = $_SESSION['id'];
    $found = false;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['idMembre'] == $sessionId) {
                $found = true;
                break;
            }
        }
    }
    if ($found) {
        ?>
        <?php include_once "header.php";
        $_SESSION['conv'] = $_GET['conv'] ?>
        <?php
        include_once "phpclass/menu.php"
        ?>
        <body>
        <div class="wrapper">
            <section class="chat-area">
                <header>
                    <?php
                    $sql = mysqli_query($database, "SELECT * FROM conversation WHERE id = {$_GET['conv']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    } else {
                        header("location: users.php");
                    }
                    ?>
                    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="ressources/profil_image/<?php echo $row['image']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['nom'] ?></span>
                        <p></p>
                    </div>
                </header>
                <div class="chat-box">

                </div>
                <form action="#" class="typing-area" method="post">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $_GET['conv']; ?>"
                           hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                           autocomplete="off">
                    <button type="submit" name="send"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>

        <script src="javascript/chat.js"></script>
        <?php
        include_once "phpclass/foot.php";
        ?>
        </body>
        </html>
        <?php
    } else {
        header('Location: users.php');
    }
} else {
    header('Location: users.php');
}
?>