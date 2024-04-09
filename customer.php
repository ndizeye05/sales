<?php
    session_start();
    include("conn.php");
    if(!$_SESSION['Uid']){
        header("location: Login.php");
    }
    if(isset($_GET['cid'])){
        if($_GET['cid']!=""){
            $cid=$_GET['cid'];
            $upsel=mysqli_query($conn,"SELECT*from customer where customerid=$cid");
            $fez=mysqli_fetch_array($upsel);
        }else{
            ?><script>window.location.replace("customer.php");</script><?php
        }
    }
?>

<script>
        $(document).ready(function(){
            $("#up").hide();
        });
    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="endpro.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="bootstrap.css">
    <script src="jquery-3.6.3.js"></script>
    <title>Document</title>
</head>
<body style="background: whitesmoke;">
    <div class="w3-panel w3-blue-grey"><center><h1 class="w3-jumbo w3-text-white"><div class="newh1">SALES MANAGEMENT SYSTERM</div></h1></center></div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="product.php" class="w3-text-white w3-large" style="text-decoration: none;">Customer</a></div></div>
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="customer.php" class="w3-text-white w3-large" style="text-decoration: none;">Product</a></div></div>
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="stockin.php" class="w3-text-white w3-large" style="text-decoration: none;">NewSales</a></div></div>
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="stockout.php" class="w3-text-white w3-large" style="text-decoration: none;">Loans</a></div></div>
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="report.php" class="w3-text-white w3-large" style="text-decoration: none;">Report</a></div></div>
        <div class="col-1"></div>
        <div class="col-1"><div class="w3-card w3-blue-grey w3-round" style="height: 40px;"><a href="logout.php" class="w3-text-white w3-large" style="text-decoration: none;">Logout</a></div></div>
    </div>
    <br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="w3-modal w3-animate-zoom" id="modal">
        <div class="w3-modal-content" id="mcont" style="background: transparent;">
            <div class="w3-round-xlarge w3-blue-grey">
                <center>
                    <form action="#" class="w-75" method="post">
                        <div class="w3-display-topright"><span onclick="$('#modal').hide()" class="w3-jumbo w3-text-red">&times;</span></div>
                        <center>
                            <h1 class="w3-xxlarge">Add a Product</h1>
                            <div class="">
                                <label for="">Product name</label><br>
                                <input type="text" name="cname" class="form-control" required>
                            </div><br>
                            <div class="">
                            <input type="submit" name="add" value="Add" class="btn btn-success w-50"><br>
                        </center>
                    </form>
                </center>
            </div>
            <?php
                if(isset($_POST['add'])){
                    $cname=$_POST['cname'];
                    $lcname=strtolower($cname);
                    if(preg_match("/^[a-zA-Z, ]*$/",$cname)){
                        $select=mysqli_query($conn,"SELECT*from customer where lower(customer_name)='$lcname'");
                        if(mysqli_num_rows($select)==0){
                            $ins=mysqli_query($conn,"INSERT into customer values(null,'$cname')");
                            if($ins){
                                ?><script>window.location.replace("customer.php");</script><?php
                            }else{
                                ?>
                                <script>
                                    alert("Sorry!! productname has been taken");
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <script>
                                alert("Sorry!! productname Already known");
                            </script>
                            <?php
                        }
                    }else{
                        ?>
                        <script>
                            alert("Sorry!! productname must only contain Letters and space");
                        </script>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    <button class="btn w3-teal" onclick="$('#modal').show()" id="addd">Add a new product</button>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    <br><br>
    <table class="w3-table" id="myTable">
        <tr class="header">
            <th><center><b>N<sup><u>o</u></sup></b></center></th>
            <th><center>Product Name</center></th>
            <th colspan="2"><center>Modify</center></th>
        </tr>
        <?php
            $sel=mysqli_query($conn,"SELECT*from customer");
            $x=1;
            while($row=mysqli_fetch_array($sel)){
                $ppid=$row['customerid'];
                ?>
                <tr>
                    <td><center><?=$x?></center></td>
                    <td><center><?=$row['customer_name']?></center></td>
                    <td><center><a href="customer.php?cid=<?=$row['customerid']?>"><i class="fas fa-pen w3-text-blue"></i>Update</a></center></td>
                    <td><center><button onclick="del(<?=$ppid?>)" class="delet">Delete</button></center></td>
                    <script>
                        function del(x,z){
                            var c=confirm("Are you sure you want to delete this product");
                            if(c){
                                window.location.replace("cdelete.php?cid="+x);
                            }
                        }
                    </script>
                </tr>
                <?php
                $x++;
            }
        ?>
    </table>
    
    <div class="w3-display-left w3-round-xlarge w3-blue-grey w-25" id="up">
        <center>
            <form action="#" class="w-75" method="post">
                <center>
                    <h1 class="w3-xxlarge">Update <?=$fez['customer_name']?></h1>
                    <div class="">
                        <label for="">Product name</label><br>
                        <input type="text" value="<?=$fez['customer_name']?>" name="cname" class="form-control" required>
                    </div><br>
                    <div class="">
                    <input type="submit" name="up" value="Update" class="btn btn-success w-50">
                    <a href="customer.php" class="btn btn-danger w-25">Cancel</a>
                    <br>
                </center>
            </form>
            <?php
                if(isset($_POST['up'])){
                    $cname=$_POST['cname'];
                    $lcname=strtolower($cname);
                    if(preg_match("/^[a-zA-Z, ]*$/",$cname)){
                        $select=mysqli_query($conn,"SELECT*from customer where lower(customer_name)='$lcname' and customerid!=$cid");
                        if(mysqli_num_rows($select)==0){
                            $ins=mysqli_query($conn,"UPDATE customer set customer_name='$cname' where customerid=$cid");
                            if($ins){
                                ?><script>window.location.replace("customer.php");</script><?php
                            }else{
                                ?>
                                <script>
                                    alert("Sorry!! productname has been taken");
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <script>
                                alert("Sorry!! productname Already known");
                            </script>
                            <?php
                        }
                    }else{
                        ?>
                        <script>
                            alert("Sorry!! productname must only contain Letters and space");
                        </script>
                        <?php
                    }
                }
            ?>
        </center>   
    </div>
    <script>
        $(document).ready(function(){
            $("#up").hide();
        });
    </script>
    <?php
        if(isset($_GET['cid'])){
            if($_GET['cid']!=""){
                ?>
                <script>
                    $(document).ready(function(){
                        $("table").css("width","75%");
                        $("table").css("margin-left","22%");
                        $("#up").show();
                        $("#addd").hide();
                    });
                </script>
                <?php
            }else{
                ?><script>window.location.replace("customer.php");</script><?php
            }
        }
    ?>
    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    
</body>
</html>