<?php
    session_start();
    include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>
<body style="background: whitesmoke;">
    <div class="w3-panel w3-blue-grey"><center><h1 class="w3-jumbo w3-text-white">SALES MANAGEMENT SYSTERM</h1></center></div><br><br>
    <br><br>    
    <div class="w3-display-middle w3-round-xlarge w3-blue-grey">
        <center>
            <form action="#" class="w-75" method="post">
                <center>
                    <h1 class="w3-xxlarge">Login Here</h1>
                    <div class="">
                        <label for="">Username</label><br>
                        <input type="text" name="uname" class="form-control" required>
                    </div><br>
                    <div class="">
                        <label for="">Password</label><br>
                        <input type="password" name="pass" class="form-control" required>
                    </div><br>
                    <input type="submit" name="log" value="Login" class="btn btn-success w-50"><br>
                    <p id="result"></p><br>
                    Don't have an account? <a href="signup.php" style="text-decoration: none; color: whitesmoke;">Register now</a>
                </center>
            </form>
        </center>
        <?php
            if(isset($_POST['log'])){
                $uname=$_POST       ['uname'];
                $pass=md5($_POST['pass']);
                if(mysqli_num_rows(mysqli_query($conn,"SELECT*from user where Username='$uname'"))>0){
                    if(mysqli_num_rows($b=mysqli_query($conn,"SELECT*from user where Username='$uname' and `Password`='$pass'"))>0){
                        $fetch=mysqli_fetch_array($b);
                        $_SESSION['Uid']=$fetch['User_id'];
                        header("location: product.php");
                    }else{
                        ?>
                        <script>
                            document.getElementById('result').innerHTML="Username isn't recognised in our system";
                        </script>
                        <?php
                    }
                }else{
                    ?>
                    <script>
                        document.getElementById('result').innerHTML="Username isn't recognised in our system";
                    </script>
                    <?php
                }
            }
        ?>
    </div>
</body>
</html>