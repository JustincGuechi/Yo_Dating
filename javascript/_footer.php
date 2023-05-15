<?php

?>
<script>
    function deleteNotif(idNotification) {
        $.ajax({
            type : "POST",
            url: "_ajax_del_notification.php",
            dataType: "html",
            data: {
                idNotification:idNotification
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
            url: "_ajax_lire_notification.php",
            dataType: "html",
            data: {
                idNotification: idNotification
            },
            success: function (msg) {
                // mettre à jour l'affichage des notifs en changeant la classe de lanotification pour changer ça couleur en gris au lieu de vert
                $('#notif_'+idNotification).removeClass('alert-info').addClass('alert-secondary');
            }
        });
    }


    function updateNotifsSingle()
    {
        $.ajax({
            type: "GET",
            url: "_ajax_update_notification.php",
            dataType: "html",
            success: function (msg) {
                if (msg) {
                    $('#containerNotif') . html(msg);
                }
            }
        });
    }

    function updateNotifs()
    {
        $.ajax({
            type :"GET",
            url: "_ajax_update_notification.php",
            dataType: "html",
            success: function (msg) {
                if (msg) {
                    $('#containerNotif') . html(msg);
                }
            }
        });
        setTimeout(updateNotifs, 10000); // 10 sec}
    }
</script>
