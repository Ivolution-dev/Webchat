<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="style.css">
        </head>
    <body>
        <?php
            session_start();
            if(!isset($_SESSION['username'])) {
                header('location: index.php?code=1');
                exit();
            }
            else {
                echo("<h1>Willkommen ".$_SESSION['username']."</h1>");
            }
        ?>

        <div class="feld">
            <form id="logout"action="logout.php" method="post">
                <input  type="submit" value="Logout" name="logout">
            </form>
        </div>

        <table id="chat">
        <tr>
        <th id="Unamehd">Username</th>
        <th id="Messagehd">Message</th>
        </tr>
        </table> 
            
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script>
            
            var tbl = document.getElementById('chat');
            var tbdy = document.createElement('tbody');
            
            function createTable(ChatData) {
                var tbl = document.getElementById('chat');
                tbdy.remove();
                tbdy = document.createElement('tbody');
                for (var i = 0; i < ChatData.length; i++) {
                    var tr = document.createElement('tr');
                        var td1 = document.createElement('td');
                        var td2 = document.createElement('td');
                        td1.setAttribute("id","Uname");
                        td2.setAttribute("id","Message");
                        var te1 = document.createTextNode(ChatData[i][0]);
                        var te2 = document.createTextNode(ChatData[i][1]);
                        td1.appendChild(te1);
                        td2.appendChild(te2);
                        tr.appendChild(td1);
                        tr.appendChild(td2);
                    tbdy.appendChild(tr);
                }
                tbl.appendChild(tbdy);
            }

            function updater() {
                jQuery.ajax({
                    type: "POST",
                    url: 'updatechat.php',
                    dataType: 'json',

                    success: function (obj, textstatus) {
                        createTable(obj);
                    }
                });
            }

            updater();
            t = setInterval(updater, 1000);
        </script> 
        <div class="feld">
            <form action="sendmessage.php" method="post">
                <input type="text" name="message" autofocus autocomplete="off"><br><br>
                <input  type="submit" value="Senden" name="send"><br><br>
            </form>
        </div>
    </body>
</html>

