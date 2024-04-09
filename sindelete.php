<?php
    if(isset($_GET['pid'])){
        session_start();
        include("conn.php");
        if(!$_SESSION['Uid']){
            header("location: Login.php");
        }
        if($_GET['pid']!=""){
            $pid=$_GET['pid'];
            $del=mysqli_query($conn,"DELETE from stock_in where St_id=$pid");
            if($del){
                header("location: stockin.php");
            }else{
                ?>
                <script>
                    alert("data wasn't deleted");
                    window.location.replace('stockin.php');
                </script>
                <?php
            }
        }else{
            header("location: stockin.php");
        }
    }
?>