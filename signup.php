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
    <div class="w3-display-middle w3-round-xlarge w3-blue-grey" style="margin-top: 5%;">
        <center>
            <form action="#" class="needs-validation" style="width: 90%" method="post">
                <center>
                    <h1 class="w3-xxlarge">Create an Account</h1>
                    <div class="was-validated">
                        <label for="">Username</label><br>
                        <input type="text" name="uname" class="form-control" required>
                    </div><br>
                    <div class="was-validated">
                        <label for="">Password</label><br>
                        <input type="password" name="pass" minlength="8" class="form-control" required>
                        <div class="invalid-feedback">Password must contain at least 8 characters</div>
                    </div><br>
                    <div class="was-validated">
                        <label for="">Confirm Password</label><br>
                        <input type="password" name="cpass" minlength="8" class="form-control" required>
                        <div class="invalid-feedback">Password must contain at least 8 characters</div>
                    </div><br>
                    <input type="submit" name="log" value="Register" class="btn btn-success w-50"><br>
                    <p id="result"></p><br>
                    Already have an account? <a href="Login.php" style="text-decoration: none; color: whitesmoke;">Login here</a>
                </center>
            </form>
        </center>
        <?php
            if(isset($_POST['log'])){
                $uname=$_POST['uname'];
                $pass=md5($_POST['pass']);
                $cpass=md5($_POST['cpass']);
                if(preg_match("/^[a-zA-Z]*$/",$uname)){
                    if(strlen($pass)>7){
                        if($pass==$cpass){
                            $insert=mysqli_query($conn,"INSERT into user values(null,'$uname','$pass')");
                            if($insert){
                                header("location: Login.php");
                            }else{
                                ?>
                                <script>
                                    document.getElementById('result').innerHTML="Sorry!! Username has been taken try another one";
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <script>
                                document.getElementById('result').innerHTML="Password don't match";
                            </script>
                            <?php
                        }
                    }else{
                        ?>
                        <script>
                            document.getElementById('result').innerHTML="Password must contain at least 8 characters";
                        </script>
                        <?php
                    }
                }else{
                    ?>
                    <script>
                        document.getElementById('result').innerHTML="Username must only be contained by Letters";
                    </script>
                    <?php
                }
            }
        ?>
    </div>
</body>
</html>