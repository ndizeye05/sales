<?php
    if(isset($_GET['cid'])){
        session_start();
        include("conn.php");
        if(!$_SESSION['Uid']){
            header("location: Login.php");
        }
        if($_GET['cid']!=""){
            $cid=$_GET['cid'];
            $del=mysqli_query($conn,"DELETE from customer where customerid=$cid");
            if($del){
                header("location: customer.php");
            }else{
                ?>
                <script>
                    alert("data wasn't deleted");
                    window.location.replace('customer.php');
                </script>
                <?php
            }
        }else{
            header("location: customer.php");
        }
    }
?>