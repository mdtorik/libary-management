<?php

if(isset($_POST["btnSave"])){

    if(count($_SESSION["invoice"])>0){
     // print_r($_POST);

        $supplier_id=$_POST["cmbpublisher"];
        $ref_no=$_POST["txtRef"];
        $order_id=$_POST["txtorder"];
        $payment_due=$_POST["duedate"];
        $Account=$_POST["txtaccount"];
        
        $remark="na";

        date_default_timezone_set("Asia/Dhaka");
        $purchase_at=date("Y-m-d",strtotime($_POST["txtdate"]));
        
        $db->query("insert into {$ex}parchases(publishers_id,parchases_date,ref_no,order_id,payment_due,account)values('$supplier_id','$purchase_at','$ref_no','$order_id','$payment_due','$Account')");

        $purchase_id=$db->insert_id;
        
        foreach($_SESSION["invoice"] as $k=>$v){       
          $db->query("insert into {$ex}parchase_details(publishers_id,product_id,parchases_id,Quentity,cost,total)values('$supplier_id','$v[id]','$purchase_id','$v[qty]','$v[price]','$v[total]')");
        }

        unset($_SESSION["invoice"]);
    }else{
        
      $message="<b style='color:orange;'>No item found</b>";

    }
  }




    if(isset($_POST["btnDel"])){
    
        $id=$_POST["txtId"];
        if(array_key_exists($id,$_SESSION["invoice"])){
             unset($_SESSION["invoice"][$id]);
        }
    
      }
      if(!isset($_SESSION["invoice"])){
        $_SESSION["invoice"]=[];
       }
      
    if(isset($_POST["btnAdd"])){
        $id=$_POST["cmbproduct"];
        $qty=$_POST["txtQty"];
        $price=$_POST["txtprice"];

        $product_row=$db->query("select b.title,b.price from lib_books b where b.id='$id'");
        $row=$product_row->fetch_object();

        if(array_key_exists($id,$_SESSION["invoice"])){
            $_SESSION["invoice"][$id]["qty"]+=$qty;
            $_SESSION["invoice"][$id]["total"]=$_SESSION["invoice"][$id]["qty"]*$price;
        }else{
            $_SESSION["invoice"][$id]["id"]=$id;
            $_SESSION["invoice"][$id]["title"]=$row->title;
            $_SESSION["invoice"][$id]["qty"]=$qty;
            //$_SESSION["invoice"][$id]["name"]=$row->name;
            $_SESSION["invoice"][$id]["price"]=$price;
            $_SESSION["invoice"][$id]["total"]=$qty*$price;
        }
    }
?>

<!--header section-->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
            <div class="col">
                <h1 class="m-0 text-dark">
                    Parchases Invoice
                </h1>
            </div>
            <div class="col">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage User</li>
                </ol>
            </div>
      </div>
   </div>
</div>

<div class="content">   
   <div class="container">     
      <div class="row">
            <div class="col-sm-11">    
                <div class="invoice p-3 mb-3">
                        <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                            <i class="fas fa-globe"></i> <b>MS BOOK SHOP</b>
                            <small class="float-right"></small>
                            </h4>
                        </div>
                                <!-- /.col -->
                    </div>
                    
                                <!-- info row -->
                        <form action="#" method="post" name="frmPurchase" id="frmPurchase">
                            <input type="hidden" name="btnSave" value="save">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <div>
                                        <?php
                                            $supplers_rs=$db->query("select id,name from {$ex}publishers");
                                            //echo select_box_query("cmbsupplier",$supplers_rs);
                                            $vendors=[];
                                            while(list($id,$name)=$supplers_rs->fetch_row()){
                                                $vendors[$id]=$name;
                                            }
                                            echo select_box2("cmbpublisher",$vendors);
                                        ?>
                                    </div>
                                    <address>
                                        <div id="tct">

                                        </div>                                        
                                    </address>
                                </div>
                                    <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    shiping address   
                                </div>
                                    <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <div>
                                    <b>Invoice #
                                        <?php
                                            $rs_row=$db->query("select max(id)+1 count from {$ex}parchases");
                                            $row=$rs_row->fetch_object();
                                            echo $row->count==null?1:$row->count;
                                        ?>
                                    </b>
                                    </div>
                                    <div class="text-right">
                                    <?php echo text_field_2("Date : ","txtdate"); ?>
                                    <?php echo text_field_1("Ref_no : ","txtRef"); ?>
                                    <?php echo text_field_1("Order ID : ","txtorder"); ?>
                                    <?php echo text_field_2("Payment Due : ","duedate"); ?>
                                    <?php echo text_field_1("Account : ","txtaccount"); ?>
                                    </div>
                                    <!-- <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Payment Due:</b> 2/22/2014<br>
                                    <b>Account:</b> 968-34567 -->
                                </div>
                                <!-- /.col -->
                            </div>
                    </form>
                        <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <form action="#" method="POST">
                                        </th>
                                            <th>
                                                <?php
                                                    $products_rs=$db->query("select id,name from lib_products");
                                                    echo select_box_query("cmbproduct",$products_rs);
                                                ?>
                                            </th>
                                            <th><?php echo text_field_nolabel("txtQty"); ?></th>
                                            <th><?php echo text_field_nolabel("txtprice"); ?></th>
                                        <th>
                                        
                                        <button type="submit" name="btnAdd" value="Add" class="btn btn-block btn-success" style="margin-bottom:15px;">Add</button>
                    
                                        <!-- <input type="submit" name="btnAdd" value="Add"> -->
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        $subtotal=0;
                                        if(is_array($_SESSION["invoice"])){
                                            foreach($_SESSION["invoice"] as $k=>$v){
                                                echo "<tr>";
                                                echo "<td>".$i++."</td>";
                                                echo "<td><img src='../project/img/$k.jpg' width='40'/>$v[title]</td>";
                                                echo "<td>$v[qty]</td>";
                                                echo "<td>$v[price]</td>";
                                                echo "<td>$v[total]</td>";
                                                echo "<td><form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$k' /><button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='far fa-trash-alt'></i></button></form></td>";
                                                echo "</tr>";
                                                $subtotal+=$v["total"];
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                        <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-9">
                        <h3>Payment Method: </h3>
                           <img src="img/payment.png" style="width:400px; height:35px;">
                        </div>
                        <!-- /.col -->
                        <div class="col-3">
                            <p class="lead">Amount Due 2/22/2014</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><?php  echo $subtotal?></td>
                                        </tr>
                                        <tr>
                                            <th>Tax (5%)</th>
                                            <td>
                                                <?php
                                                $tax=$subtotal*(5/100);
                                                echo $tax;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>
                                                <?php 
                                                $shipping_cost=80;
                                                echo $shipping_cost;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><?php echo $subtotal+$tax+$shipping_cost ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            <button type="button" name="btnSubmit" id="btnSubmit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                            Payment
                            </button>
                            <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
  $("#btnSubmit").on("click",function(){
    if(confirm('Are you sure?')){
      $("#frmPurchase").submit();
    }
  });
  $("#cmbproduct").on("change",function(){
      let product_id=$(this).val();
      $.ajax({
          method:"GET",
          url:"api/get_price.php?product_id="+product_id,
          success:function(html){
              $("#txtprice").val(html);
          }
      });
  });
  $("#cmbpublisher").on("change",function(){
      let id=$(this).val();
      $.ajax({
          method:"GET",
          url:"api/get_add.php?id="+id,
          success:function(html){
              $("#tct").html(html);
          }
      });
  });
});
</script>