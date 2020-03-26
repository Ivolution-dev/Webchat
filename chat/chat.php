<!DOCTYPE html>
    <html lang="de">
        <head>
            <title>Webchat</title> 
            <meta charset="utf-8">
            <link rel="stylesheet" href="../style.css?v=8">
            <link rel="icon" type="image/png" href="../logo.png">
        </head>
    <body>
        <?php
            session_start();
            if(!isset($_SESSION['username'])) {
                session_start();
                $_SESSION['codeAnmelden'] = "<div id='error'>Melde dich bitte erstmal an!</div>";
                header('location: ../index.php');
                exit();
            }               
            
            
            
        ?>
        <div class="header">
            <h1>Webchat by  </h1>
            <img src="../logo.png">
        </div>

        <?php
            echo("<p>Du bist eingeloggt als: ".$_SESSION['username']."</p>");
        ?>

        <div class="logout">
            <form id="lgbtn" action="../account/logout.php" method="post">
                <input id="logobtn" type="submit" value="Logout" name="logout">
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
            <form action="sendmessage.php" method="post">
                <input type="text" name="message" autofocus autocomplete="off"><br><br>
                <input  type="submit" value="Senden" name="send"><br><br>
            </form>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script>

            var length = 0;
            
            var tbl = document.getElementById('chat');
            var tbdy = document.createElement('tbody');
            
            function createTable(ChatData) {
                if (ChatData.length > length)
                {
                    length = ChatData.length;
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
                        if (ChatData.length - 1 == i)
                        {
                            tr.setAttribute("class","fade");
                        }
                    }
                    tbl.appendChild(tbdy);
                }
            }

            function updater() {
                jQuery.ajax(
                {
                    type: "POST",
                    url: 'updatechat.php',
                    dataType: 'json',

                    success: function (obj, textstatus) {
                        createTable(obj);
                    }
                }
                );
            }

            updater();
            t = setInterval(updater, 1000);

        </script>
    </body>
</html>

