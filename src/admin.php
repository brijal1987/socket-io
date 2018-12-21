<!doctype html>
<html>
  <head>
    <title>Admin Dashboard</title>
    <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font: 13px Helvetica, Arial; }
      form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
      form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
      form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages li { padding: 5px 10px; }
      #messages li:nth-child(odd) { background: #eee; }
    </style>
  </head>
  <body>
    <h1>Admin Dashboard</h1>
<div>This is message from Users</div>
<h1 id="message"></h1>
<script src="../node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<?php
require('include/config.php');
?>
<script>
    var socket_url = "<?php echo SOCKET_SERVER_URL; ?>";
    $(function(){
        var socket = io(socket_url);
        console.log("Socket connected"+socket.connected);

        socket.on('notification', function(data){
            //insert your code here
            console.log(data)
            $("#message").append('<br/>User (<b>' + data.user + '</b>) has added message : "' + data.message + '" On ' + new Date($.now()))
        });
    });

</script>
</body>
</html>