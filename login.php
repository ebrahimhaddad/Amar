<?php
include 'config.php';
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);
    $mypassword = hash('sha256', $mypassword);
    $myname = mysqli_real_escape_string($db, $_POST['name']);
    $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<html>
<head>
    <title>صفحه ورود</title>
    <link rel="stylesheet" href="css/login.css">
    <title>اداره کل برنامه ریزی و بودجه دیوان عدالت اداری</title>
</head>
<body>
<div id="main">
    <!--<div></div>-->
    <div class="logo">
        <header>
            <h2>سامانه جامع آماری دیوان عدالت اداری - سجاد</h2>
        </header>
        <form action="" method="post">
            <table class="tbl">
                <tr>
                    <th COLSPAN="2" style="background-color:#30a0b0; color: #16161d;">ورود کاربر</th>
                </tr>
                <tr>
                    <td><label>نام کاربری :</label></td>
                    <td><input type="text" name="username" class="box"/></td>
                </tr>
                <tr>
                    <td><label>گذرواژه :</label></td>
                    <td><input type="password" name="password" class="box"/></td>
                </tr>
                <input type="hidden" name="name" class="box"/>
                <tr style="text-align: center; ">
                    <td colspan="2"><input class="go" type="submit" value=" ورود "/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="clear"></div>
    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
    </div>
</body>
</html>