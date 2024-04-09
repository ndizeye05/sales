<?php
    if(isset($_GET['pid'])){
        session_start();
        include("conn.php");
        if(!$_SESSION['Uid']){
            header("location: Login.php");
        }
        if($_GET['pid']!=""){
            $pid=$_GET['pid'];
            $inid=$_GET['inid'];
            $q=$_GET['q'];
            $up=mysqli_query($conn,"UPDATE stock_in set Quantity=Quantity+$q where St_id=$inid");
            $del=mysqli_query($conn,"DELETE from stock_out where So_id=$pid");
            if($del&&$up){
                header("location: stockout.php");
            }else{
                ?>
                <script>
                    alert("data wasn't deleted");
                    window.location.replace('stockout.php');
                </script>
                <?php
            }
        }else{
            header("location: stockout.php");
        }
    }
?>