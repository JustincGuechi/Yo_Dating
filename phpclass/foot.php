<?php
?>
<footer>
    <div class="footer-content">
        <div class="commercial">
            <h3>&copy; <?php echo $YEAR ?> - <a href="easter.html"
                                                style="text-decoration: none; color: #fff"> <?php echo $OWNER ?> </a> -
            </h3>
        </div>
        <div class="text">
            <p> Tous droits réservés </p>
        </div>
    </div>
</footer>
<?php

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function deleteNotif(idNotification) {
        $.ajax({
            type: "POST",
            url: "javascript/_ajax_del_notification.php",
            dataType: "html",
            data: {
                idNotification: idNotification
            },
            success: function (msg) {
                // mettre à jour l'affichage des notifs
                updateNotifsSingle();

            }
        });
    }


    function lireNotif(idNotification) {
        $.ajax({
            type: "POST",
            url: "javascript/_ajax_lire_notification.php",
            dataType: "html",
            data: {
                idNotification: idNotification
            },
            success: function (msg) {
                // mettre à jour l'affichage des notifs en changeant la classe de lanotification pour changer ça couleur en gris au lieu de vert
                $('#notif_' + idNotification).removeClass('alert-info').addClass('alert-secondary');
            }
        });
    }


    function updateNotifsSingle() {
        $.ajax({
            type: "GET",
            url: "javascript/_ajax_update_notification.php",
            dataType: "html",
            success: function (msg) {
                if (msg) {
                    $('#menu-notif').html(msg);
                }
            }
        });
    }

    function updateNotifs() {
        $.ajax({
            type: "GET",
            url: "javascript/_ajax_update_notification.php",
            dataType: "html",
            success: function (msg) {
                if (msg) {
                    $('#menu-notif').html(msg);
                }
            }
        });
        setTimeout(updateNotifs, 10000); // 10 sec}
    }
</script>
