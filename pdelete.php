<?php
    if(isset($_GET['pid'])){
        session_start();
        include("conn.php");
        if(!$_SESSION['Uid']){
            header("location: Login.php");
        }
        if($_GET['pid']!=""){
            $pid=$_GET['pid'];
            $del=mysqli_query($conn,"DELETE from products where productid=$pid");
            if($del){
                header("location: product.php");
            }else{
                ?>
                <script>
                    alert("data wasn't deleted");
                    window.location.replace('product.php');
                </script>
                <?php
            }
        }else{
            header("location: product.php");
        }
    }
?>