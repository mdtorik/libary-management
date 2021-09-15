<?php

$in_id=$_POST["i_id"];
//echo ($in_id);
$sql="select p.*, pd.name,pd.phone,pd.email,pd.address from {$ex}parchases p,{$ex}publishers_details pd where p.id='$in_id' and p.publishers_id=pd.id";
$pubs=$db->query($sql);
$pub=$pubs->fetch_object();
//  while($pub=$pubs->fetch_row()){
//  }

// $sql_2="select pd.*,i.item_description from dve_purchase_details pd,items i where pd.purchase_id ='$in_id' and pd.product_id=i.id";
// $pds=$conn->query($sql_2);


 ?>

<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
              Purchase Invoice
            </h1>
         </div>
      </div>
   </div>
</div>

<div class="content">
   
   <div class="container">
     
      <div class="row">
         <div class="col-sm-12 card">

         <div class="text-center mt-3"><?php echo isset($message)?$message:""?></div>

            <div class="invoice p-3 mb-3">
      
              <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                    <h4><img src="images/dve_logo.png" alt="" width="40"> MS BOOK SHOP</h4>
                    From <br><b>
                    <?php echo "Name : ".$pub->name; ?></b> <br>                    
                    <?php echo "<b>"."Phone : "."</b>".$pub->phone; ?></b> <br>                    
                    <?php echo "<b>"."Email : "."</b>".$pub->email; ?></b> <br>                    
                    <?php echo "<b>"."Address : "."</b>".$pub->address;?>                    
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>Invoice No :</b></label>
                    <div class='col-sm'> <b>
                      <?php
                      echo $pub->id;
                      ?></b>
                    </div> 
                  </div>
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>Date :</b></label>
                    <div class='col-sm'> <b>
                      <?php
                        echo $pub->parchases_date;
                      ?></b>
                    </div> 
                  </div>
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>Ref :</b></label>
                    <div class='col-sm'> <b>
                      <?php
                        echo $pub->ref_no;
                      ?></b>
                    </div> 
                  </div>
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>order_id :</b></label>
                    <div class='col-sm'> <b>
                      <?php
                        echo $pub->order_id;
                      ?></b>
                    </div> 
                  </div>
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>Payment Due :</b></label>
                    <div class='col-sm'> <b>
                      <?php
                       echo $pub->payment_due;
                      ?></b>
                    </div> 
                  </div>
                  <div class='form-group row'>
                    <label class='col-sm-5 text-right'><b>Account No : </b></label>
                    <div class='col-sm'> <b>
                      <?php
                       echo $pub->account;
                      ?></b>
                    </div> 
                  </div>
                  
                </div>
                <!-- /.col -->
                
              </div>
                <!-- /.row -->

              <!-- Table row -->
              <div class="row card">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Product</th>                    
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total Price</th>                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        // 
                        // $items=ParchasView::get_parchases();
                              
                        //       foreach($items as $item){

                                

                    //  $i=1;
                      //$subtotal=0;
                    //  $sql_2="select pd.*,i.item_description item_name from dve_purchase_details pd,items i where pd.purchase_id ='$in_id' and pd.product_id=i.id";
                    //  $pds=$conn->query($sql_2);
                    //  while(list($id,$purchase_id,$product_id,$qty,$cost,$item)=$pds->fetch_row()){
                    // //  while($pd=$pds->fetch_object()){
                      // $sql="select pb.name,p.name pnam,pa.ref_no,pde.Quentity,pa.parchases_date,pde.cost,pde.total from {$ex}products p,{$ex}parchases pa,{$ex}parchase_details pde,{$ex}publishers pb where pde.publishers_id=pb.id and pa.publishers_id=pb.id and p.id=pde.product_id and pa.id='$in_id' order by name";
                      // $items=$db->query($sql);   
                      //   while($item=$items->fetch_object()){

                      
                     // $subtotal=0;
                     $id=0;
                      $sql="select p.id,p.name ,pa.ref_no,pde.Quentity,pa.parchases_date,pde.cost,pde.total from {$ex}products p,{$ex}parchases pa,{$ex}parchase_details pde,{$ex}publishers pb where pde.publishers_id=pb.id and pa.publishers_id=pb.id and p.id=pde.product_id and pa.id='$in_id' order by name";
                      $items=$db->query($sql); 
                      $row=$items->fetch_object();      
                        //while($item=$items->fetch_object()){

                          $_SESSION["invoice1"][$id]["id"]=$row->id;
                          $_SESSION["invoice1"][$id]["name"]=$row->name;
                          $_SESSION["invoice1"][$id]["qty"]=$row->Quentity;
                          $_SESSION["invoice1"][$id]["cost"]=$row->cost;
                          $_SESSION["invoice1"][$id]["total"]=$row->total;
                          //$_SESSION["invoice1"][$id]["subtotal"]+=$_SESSION["invoice"][$id]["totalprice"];
                       
                       $id=1;
                       $subtotal=0;
                       foreach($_SESSION["invoice1"] as $k=>$v){
                       echo "<tr>";
                       echo "<td width='10%'>".$id++."</td>";
                       echo "<td width='40%'>$v[name]</td>";
                       echo "<td width='10%'>$v[qty]</td>";
                       echo "<td width='20%'>$v[cost]</td>"; 
                       echo "<td width='20%'>$v[total]</td>";
                       echo "</tr>";
                       $subtotal+=$v["total"];
                    };
                      
                     
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-8">
                 
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                            <th style="width:35%">Subtotal:</th>
                            <td><?php echo $subtotal ?></td>
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
                            <td><?php 
                            $shipping_cost=80;
                            echo $shipping_cost;
                            ?></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td><?php echo $subtotal+$tax+$shipping_cost ?></td>
                            <td ></td>
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
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">Generate PDF</button>
                </div>
              </div>
            </div>
        </div>  


    </div>
  </div>
</div>
