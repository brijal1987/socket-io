<?php 
session_start();
require('include/config.php');
$is_loggedIn = isset($_SESSION['userID']) ? $_SESSION['userID'] :0;
$page_title = ($is_loggedIn?'Dashboard':'Login');
if(isset($_GET['action'])) {
  unset($_SESSION['userID']);
  header("Location:./user.php");
  exit;
} 
if(isset($_POST['login'])) {  
  $_SESSION['userID'] = isset($_POST['user'])?$_POST['user']:'';
  header("Location:./user.php");
  exit;
} 
?>
<script src="../node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script>
    var socket_url = "<?php echo SOCKET_SERVER_URL; ?>";
</script>
<!doctype html>
<html>
  <head>
    <title>User <?php echo $page_title; ?></title>
  </head>
  <body>
  <?php if($is_loggedIn) { ?> 
  <a style="float: right" href="user.php?action=logout">Logout</a>
  <h1>User Dashboard</h1>
  <h2>Welcome <big><?php echo $_SESSION['userID'];?> </big></h2>
  <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['userID'];?>">
  <input type="text" name="message" id="message">
  </br>
  <input type="button" name="submit" id="submit" value="Button">

<script>
    $(function(){
        var socket = io(socket_url);
        console.log("Socket connected"+socket.connected);

        $('#message').keypress(function(e) {
            if (e.keyCode == '13') {
                $('#submit').trigger('click');
            }
        });

         $('#submit').click(function(){
            var data = {
              'message' :$('#message').val(),
              'user' :$('#user').val(), 
            }
            socket.emit('call_message', data);
            $('#message').val('');
            $('#message').focus();
            return false;
        });
         $('#message').focus();
    });

</script>
<?php }else{ ?>
  <h1>User <?php echo $page_title; ?></h1>
  <form action="user.php" method="post" >
  Enter your name and start <input type="text" name="user" id="user"> &nbsp;<input type="submit" name="login" id="login" value="Login">
  </form>

<script>
    $(function(){
        $('#user').keypress(function(e) {
            if (e.keyCode == '13') {
                $('#login').trigger('click');
            }
        }); 
        $('#user').focus();  

    });

</script>
<?php } ?>
</body>
</html>