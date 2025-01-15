<?php 
  session_start(); 
  include "config.php";
?>
<html>
  <head>
    <title>PHP MySql Login Logout with Session</title>
    <link rel='stylesheet' type='text/css' href='style.css' >
  </head>
  <body>
    <form action='<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id='form'>
      <table>
        <tr>
          <td colspan='2' class='heading'>Login Form</td>
        </tr>
        <tr>
          <td><label>User Name</label></td>
          <td><input type='text' name='user_name' class='input' required></td>
        </tr>
        <tr>
          <td><label>Password</label></td>
          <td><input type='password' name='user_pass' class='input' required></td>
        </tr>
        <tr>
          <td></td>
          <td><input type='submit' name='submit' class='btn' value='Login'></td>
        </tr>
      </table>
      <?php 
        if(isset($_POST["submit"])){
          $u_name=mysqli_real_escape_string($con,$_POST["user_name"]);
          $u_pass=mysqli_real_escape_string($con,$_POST["user_pass"]);
          $sql="select uid,uname from users where uname='{$u_name}' and upass='{$u_pass}'";
          $res=$con->query($sql);
          if($res->num_rows>0){
            $row=$res->fetch_assoc();
            $_SESSION["user_id"]=$row["uid"];
            $_SESSION["user_name"]=$row["uname"];
            header("location:home.php");
          }else{
            echo "<div class='msg-danger'>Invalid Login!!!</div>";
          }
        }
      ?>
    </form>
  </body>
</html>