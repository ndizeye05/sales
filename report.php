<?php
    session_start();
    include("conn.php");
    if(!$_SESSION['Uid']){
        header("location: Login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="bootstrap.css">
    <script src="jquery-3.6.3.js"></script>
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
    <h3 id="ss">Select option:</h3>
    <select name="" id="sel" style="margin-top: -35px;margin-left: 200px" class="form-control w-25">
        <option value="all">All Post</option>
        <option value="in">Sells Detail</option>
        <option value="out">Loans Detail</option>
    </select>
    <button onclick="print()" id="print" class="btn w3-teal w3-display-right w3-large w-25" style="margin-top: -90px">Print</button>
    <br><br><br>
    <script>
        function pri(){
            $("#nav,#sel,#print,#ss").hide();
            var x=print();
            $("#nav,#sel,#print,#ss").show();
        }
    </script>
    <table class="w3-table" id="intable">
        <h1 class="w3-xxxlarge" id="i"><center>Sells Detail Report</center></h1>
        <tr>
            <th><center><b>N<sup><u>o</u></sup></b></center></th>
            <th><center>Customer Name</center></th>
            
            <th><center>Date</center></th>
            <th><center>Product Name</center></th>
            <th><center>Quantity</center></th>
            <th><center>Unit Price</center></th>
            <th><center>Total Price</center></th>
            <th><center>Payed</center></th>
            <th><center>Remained</center></th>
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
                </tr>
                <?php
                $x++;
            }
        ?>
    </table>
    <br><br><br><br>
    <table class="w3-table" id="outtable">
        <h1 class="w3-xxxlarge"  id="o"><center>Loans Detail Report</center></h1>
        <tr>
            <th><center><b>N<sup><u>o</u></sup></b></center></th>
            <th><center>Customer Name</center></th>
            <th><center>Date</center></th>
            <th><center>Money Remained</center></th>
        </tr>
        <?php
            $sel=mysqli_query($conn,"SELECT*from products as p inner join stock_out as s on s.product_id=p.productid");
            $x=1;
            while($row=mysqli_fetch_array($sel)){
                $ppid=$row['So_id'];
                ?>
                <tr>
                    <td><center><?=$x?></center></td>
                    <td><center><?=$row['Product_name']?></center></td>
                    <td><center><?=$row['Date']?></center></td>
                    <td><center><?=$row['Remained']?></center></td>
                </tr>
                <?php
                $x++;
            }
        ?>
    </table>
    <br><br><br><br><br>
    <script>
        $(document).ready(function(){
            $("#sel").change(function(){
                var x=$(this).val();
                if(x=='all'){
                    $("#intable,#outtable,#i,#o").show();
                }else if(x=='in'){
                    $("#intable,#i").show();
                    $("#outtable,#o").hide();
                }else if(x=='out'){
                    $("#intable,#i").hide();
                    $("#outtable,#o").show();
                }
            });
        });
    </script>
</body>
</html>