<!DOCTYPE html>
<html lang="de">

<head>
    <title>Webchat</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../ressources/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <link rel="icon" type="image/png" href="../ressources/logo.png">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_start();
        $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
        header('location: ../index.php');
        exit();
    }
    ?>
    <div class="header">
        <h1>Webchat by</h1>
        <img src="../ressources/logo.png">
    </div>

    <?php
    echo ("<p class=username>Du bist eingeloggt als: " . $_SESSION['username'] . "</p>");
    ?>

    <div class="btn">
        <form id="lgbtn" action="../components/logout.php" method="post">
            <input id="logobtn" type="submit" value="Logout" name="logout">
        </form>
        <form id="lgbtn" action="../account/profile.php" method="post">
            <input id="mypbtn" type="submit" value="Profil" name="profile">
        </form>
    </div><br>
    <table id="hd">
        <tr>
            <th id="Unamehd">Username</th>
            <th id="Messagehd">Message</th>
        </tr>
    </table>
    <div id="scroll">
        <table id="chat">
        </table>
    </div><br>

    <div class="feld">
        <form action="../components/sendmessage.php" method="post">
            <input type="text" name="message" autofocus autocomplete="off"><br><br>
            <input type="submit" value="Senden" name="send"><br><br>
        </form>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script>
        var length = 0;

        var tbl = document.getElementById('chat');
        var tbdy = document.createElement('tbody');

        function getCookie(cookie) {
            var name = cookie + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function createTable(ChatData) {
            if (getCookie("length") == "") {
                document.cookie = "length=0";
            } else if (ChatData.length < parseInt(getCookie("length"))) {
                document.cookie = "length=" + ChatData.length;
            }
            var tbl = document.getElementById('chat');
            tbdy.remove();
            tbdy = document.createElement('tbody');
            for (var i = 0; i < ChatData.length; i++) {
                var tr = document.createElement('tr');
                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                td1.setAttribute("id", "Uname");
                td2.setAttribute("id", "Message");
                var te1 = document.createTextNode(ChatData[i][0]);
                var te2 = document.createTextNode(ChatData[i][1]);
                var pic = document.createElement("img");
                pic.setAttribute("id", "ChatPicture");
                pic.src = '<?php 
                            $upload_folder = '../profilepictures/'; 
                            $filename = $_SESSION['username'];
                            $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
                            foreach ($allowed_extensions as &$al_extension) {
                                $file = $upload_folder . $filename . "." . $al_extension;
                                if (file_exists($file)) {
                                    echo ($file);
                                    break;
                                }
                            } 
                            ?>';
                td1.appendChild(pic);
                td1.appendChild(te1);
                td2.appendChild(te2);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tbdy.appendChild(tr);
                if (ChatData.length - 1 == i && ChatData.length > parseInt(getCookie("length"))) {
                    tr.setAttribute("class", "fade");
                    document.cookie = "length=" + ChatData.length;
                }
                tbl.appendChild(tbdy);
            }
        }

        function updater() {
            jQuery.ajax({
                type: "POST",
                url: '../components/updatechat.php',
                dataType: 'json',

                success: function(obj, textstatus) {
                    createTable(obj);
                }
            });
        }

        updater();
        t = setInterval(updater, 1000);
    </script>
</body>

</html>