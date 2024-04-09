<?php
    session_start();
    include("conn.php");
    if(!$_SESSION['Uid']){
        header("location: Login.php");
    }
    if(isset($_GET['pid'])){
        if($_GET['pid']!=""){
            $pid=$_GET['pid'];
            // echo "<script>alert($pid)</script>";
            $upsel=mysqli_query($conn,"SELECT*from products as p inner join stock_in as s on s.product_id=p.productid where St_id=$pid");
            $fez=mysqli_fetch_array($upsel);
        }else{
            header("location: stockin.php");
        }
    }
    if(isset($_GET['out'])){
        if($_GET['out']!=""){
            $ppid=$_GET['out'];
            // echo "<script>alert($pid)</script>";
            $upsel=mysqli_query($conn,"SELECT*from products as p inner join stock_in as s on s.product_id=p.productid where St_id=$ppid");
            $fezz=mysqli_fetch_array($upsel);
        }else{
            header("location: stockin.php");
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
    <script src="end.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        #myInput {
    background-image: url('/css/searchicon.png'); /* Add a search icon to input */
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 60%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
    margin-left: 350px;
  }
    </style>
</head>
<body style="background: whitesmoke;">
    <div class="w3-panel w3-blue-grey"><center><h1 class="w3-jumbo w3-text-white">SALES MANAGEMENT SYSTERM</h1></center></div>
    <div class="row" id="nav">
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
                            <h1 class="w3-xxlarge">SALES DETAIL</h1>
                            <div class="">
                                <label for="">Customer name</label><br>
                                <select name="pname" class="form-control" required>
                                    <option value="">--Select Customer Name--</option>
                                    <?php
                                        $selll=mysqli_query($conn,"SELECT*from products");
                                        while($r=mysqli_fetch_array($selll)){
                                            ?>
                                            <option value="<?=$r['productid']?>"><?=$r['Product_name']?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div><br>
                            <div class="">
                                <label for="">Date</label><br>
                                <input type="date" name="date" class="form-control" required>
                            </div><br>
                            <div class="">
                                <label for="">Product name</label><br>
                                <select name="cname" class="form-control" required>
                                    <option value="">--Select Product Name--</option>
                                    <?php
                                        $selll=mysqli_query($conn,"SELECT*from customer");
                                        while($r=mysqli_fetch_array($selll)){
                                            ?>
                                            <option value="<?=$r['customer_name']?>"><?=$r['customer_name']?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div><br>
                            <div class="">
                                <label for="">Quantity</label><br>
                                <input type="number" min="0" name="qty" class="form-control" required>
                            </div><br>
                            <div class="">
                                <label for="">Unit Price</label><br>
                                <input type="number" min="0" name="uprice" class="form-control" required>
                            </div><br>
                            <div class="">
                                <label for="">Money Paid</label><br>
                                <input type="number" min="0" max="<?=$fezz['Total_price']?>" name="mpaid" class="form-control" required>
                            </div><br>
                            <div class="">
                            <input type="submit" name="add" value="Add" class="btn btn-success w-50"><br>
                        </center>
                    </form>
                </center>
            </div>
            <?php
                if(isset($_POST['add'])){
                    $pidd=$_POST['pname'];
                    $date=$_POST['date'];
                    $cname=$_POST['cname'];
                    $qty=$_POST['qty'];
                    $uprice=$_POST['uprice'];
                    $mpaid=$_POST['mpaid'];
                    $remained=$mpaid - ($qty*$uprice);
                    $cdate=date('Y-m-d');
                    if($date<=$cdate){
                        $ins=mysqli_query($conn,"INSERT into stock_in values(null,$pidd,'$date','$cname','$qty','$uprice',$qty*$uprice,'$mpaid','$remained')");
                        if($ins){
                            header("location: stockin.php");
                        }else{
                            ?>
                            <script>
                                alert("Productname select valid inputs");
                            </script>
                            <?php
                        }
                    }else{
                            ?>
                        <script>
                            alert("date hasn't reached yet");
                        </script>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    
      <button class="btn w3-teal" onclick="$('#modal').show()" id="addd">Sales Detail</button>
      <input type="text" id="myInput" onkeyup="myFunction()" class="search" autocomplete="off" placeholder="Search for names.." style="width: 40%;">
    
    <br><br>
    <table class="w3-table" id="myTable">
        <tr class="header">
            <th><center><b>N<sup><u>o</u></sup></b></center></th>
            <th><center>Customer Name</center></th>
            <th><center>Date</center></th>
            <th><center>Product Name</center></th>
            <th><center>Quantity</center></th>
            <th><center>Unit Price</center></th>
            <th><center>Total Price</center></th>
            <th><center>Payed</center></th>
            <th><center>Remained</center></th>
            <th colspan="3"><center>More</center></th>
        </tr>
        <?php
            $sel=mysqli_query($conn,"SELECT*from products as p inner join stock_in as s on s.product_id=p.productid");
            $x=1;
            while($row=mysqli_fetch_array($sel)){
                $ppid=$row['St_id'];
                ?>
                <tr>
                    <td><center><?=$x?></center></td>
                    <td><center><?=$row['Product_name']?></center></td>
                    <td><center><?=$row['Date']?></center></td>
                    <td><center><?=$row['customer_name']?></center></td>
                    <td><center><?=$row['Quantity']?></center></td>
                    <td><center><?=$row['Unit_price']?></center></td>
                    <td><center><?=$row['Total_price']?></center></td>
                    <td><center><?=$row['payment']?></center></td>
                    <td><center><?=$row['remained']?></center></td>
                    <td><center><a href="stockin.php?pid=<?=$row['St_id']?>"><i class="fas fa-pen w3-text-blue"></i>Update</a></center></td>
                    <td><center><button onclick="del(<?=$ppid?>)">Delete</button></center></td>
                    <td><center><a href="stockin.php?out=<?=$row['St_id']?>"><i class="fas fa-pen w3-text-blue"></i>LOANS</a></center></td>
                    <script>
                        function del(x){
                            var c=confirm("Are you sure you want to delete this Customer info");
                            if(c){
                                window.location.replace("sindelete.php?pid="+x);
                            }
                        }
                    </script>
                </tr>
                <?php
                $x++;
            }
        ?>
    </table>
    
    <div class="w3-display-left w3-round-xlarge w3-blue-grey w-25" style="margin-top: 5%;" id="up">
        <center>
            <form action="#" class="w-75" method="post">
                <!-- <div class="w3-display-topright"><span onclick="$('#modal').hide()" class="w3-jumbo w3-text-red">&times;</span></div> -->
                <center>
                    <h1 class="w3-xxlarge">Update <?=$fez['Product_name']?></h1>
                    <div class="">
                        <label for="">Customer name</label><br>
                        <select name="pname" class="form-control" required>
                            <option value="<?=$fez['productid']?>"><?=$fez['Product_name']?></option>
                            <?php
                                $selll=mysqli_query($conn,"SELECT*from products");
                                while($r=mysqli_fetch_array($selll)){
                                    if($r['productid']==$fez['productid']){
                                        continue;
                                    }
                                    ?>
                                    <option value="<?=$r['productid']?>"><?=$r['Product_name']?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div><br>
                    <div class="">
                        <label for="">Date</label><br>
                        <input type="date" value="<?=$fez['Date']?>" name="date" class="form-control" required>
                    </div><br>
                    <div class="">
                        <label for="">Quantity</label><br>
                        <input type="number" value="<?=$fez['Quantity']?>" min="0" name="qty" class="form-control" required>
                    </div><br>
                    <div class="">
                        <label for="">Unit Price</label><br>
                        <input type="number" value="<?=$fez['Unit_price']?>" min="0" name="uprice" class="form-control" required>
                    </div><br>
                    <div class="">
                                <label for="">Money Paid</label><br>
                                <input type="number" min="0" value="<?=$fez['payment']?>" name="mpaid" class="form-control" required>
                            </div><br>
                    <div class="">
                    <input type="submit" name="up" value="Update" class="btn btn-success w-50">
                    <a href="product.php" class="btn btn-danger w-25">Cancel</a>
                    <br>
                </center>
            </form>
            
            <?php
                if(isset($_POST['up'])){
                    $pidd=$_POST['pname'];
                    $date=$_POST['date'];
                    $qty=$_POST['qty'];
                    $uprice=$_POST['uprice'];
                    $mpaid=$_POST['mpaid'];
                    $cdate=date('Y-m-d');
                    if($date<=$cdate){
                        $up=mysqli_query($conn,$v="UPDATE stock_in set product_id=$pidd,`Date`='$date',Quantity='$qty',Unit_price='$uprice',Total_price=$qty*$uprice,payment='$mpaid',remained=$mpaid - ($qty*$uprice) where St_id=$pid");
                        if($up){
                            // echo $v;
                            ?><script>window.location.replace("stockin.php");</script><?php
                        }else{
                            ?>
                            <script>
                                alert("customername select valid inputs");
                            </script>
                            <?php
                        }
                    }else{
                            ?>
                        <script>
                            alert("date hasn't reached yet");
                        </script>
                        <?php
                    }
                }
            ?>
        </center>  
    </div>
    <div class="w3-display-left w3-round-xlarge w3-blue-grey w-25" style="margin-top: 5%;" id="out">
        <center>
            <form action="#" class="w-75" method="post">
                <!-- <div class="w3-display-topright"><span onclick="$('#modal').hide()" class="w3-jumbo w3-text-red">&times;</span></div> -->
                <center>
                    <h1 class="w3-xxlarge">Money Remained <?=$fezz['Product_name']?></h1>
                    <div class="">
                        <label for="">customername </label><br>
                        <select name="pname" class="form-control" required>
                            <option value="<?=$fezz['productid']?>"><?=$fezz['Product_name']?></option>
                        </select>
                    </div><br>
                    <div class="">
                        <label for="">Date</label><br>
                        <select name="date" class="form-control" required>
                            <option value="<?=$fezz['Date']?>"><?=$fezz['Date']?></option>
                        </select>
                    </div><br>
                    <div class="">
                        <label for="">Money remained</label><br>
                        <select name="qty" class="form-control" required>
                            <option value="<?=$fezz['remained']?>"><?=$fezz['remained']?></option>
                        </select>
                    </div><br>
                    <div class="">
                    <div class="">
                    <input type="submit" name="outt" value="Add Loans" class="btn btn-success w-50">
                    <a href="product.php" class="btn btn-danger w-25">Cancel</a>
                    <br>
                </center>
            </form>
            
            <?php
                if(isset($_POST['outt'])){
                    $pidd=$_POST['pname'];
                    $date=$_POST['date'];
                    $qty=$_POST['qty'];
                    $cdate=date('Y-m-d');
                    if($date>=$cdate){
                        $up=mysqli_query($conn,$v="UPDATE stock_in set remained=remained where St_id=$ppid");
                        $ins=mysqli_query($conn,"INSERT into stock_out values (null,$pidd,'$date',$qty,$ppid)");
                        if($up&&$ins){
                            // echo $v;
                            ?><script>window.location.replace("stockin.php");</script><?php
                        }else{
                            ?>
                            <script>
                                alert("customername select valid inputs");
                            </script>
                            <?php
                        }
                    }else{
                            ?>
                        <script>
                            alert("date has passed");
                        </script>
                        <?php
                    }
                }
            ?>
        </center>  
    </div>
    <script>
        $(document).ready(function(){
            $("#up,#out").hide();
        });
    </script>
    <?php
        if(isset($_GET['pid'])){
            if($_GET['pid']!=""){
                ?>
                <script>
                    $(document).ready(function(){
                        $("table").css("width","75%");
                        $("table").css("margin-left","25%");
                        $("#up").show();
                        $("#addd").hide();
                    });
                </script>
                <?php
            }else{
                header("location: products.php");
            }
        }
        if(isset($_GET['out'])){
            if($_GET['out']!=""){
                ?>
                <script>
                    $(document).ready(function(){
                        $("table").css("width","75%");
                        $("table").css("margin-left","25%");
                        $("#out").show();
                        $("#addd").hide();
                    });
                </script>
                <?php
            }else{
                header("location: products.php");
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