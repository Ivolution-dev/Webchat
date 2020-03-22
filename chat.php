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

        <table id="chat">
        <tr>
        <th id="ten">Username</th>
        <th id="ninety">Message</th>
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
                    for (var j = 0; j < 2; j++) {
                        var td = document.createElement('td');
                        var te = document.createTextNode(ChatData[i][j]);
                        td.appendChild(te);
                        tr.appendChild(td);
                    }
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

        <form action="sendmessage.php" method="post">
            <input type="text" name="message" autofocus><br><br>
            <input  type="submit" value="Senden" name="send">
        </form>
        <form action="logout.php" method="post">
            <input  type="submit" value="Logout" name="logout">
        </form>

    </body>
</html>

