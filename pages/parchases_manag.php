<?php

  if(isset($_POST["btnDel"])){
    $i_id=$_POST["txtId"];
    $sql="delete from lib_parchases where id='$i_id'";
    $db->query($sql);
    $msg_delete="Successfully Deleted";
  }
?>
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
            <div class="col">
                <h1 class="m-0 text-dark">
                    Parchases Manage
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

<div class="content-header">   
   <div class="container">     
      <div class="row">
         <div class="col">
            <table class="table table-striped" style="border:2px solid gray;">
               <thead style="bodar:1px;">
                  <tr>
                     <th>Publidher SN</th>
                     <th>Publishir name</th>
                     <th>Product_name</th>
                     <th>Ref_no</th>
                     <th>Qty</th>
                     <th>Parchases_date</th>
                     <th>Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               <?php
                 $id=1;
                  $items=ParchasView::get_parchasess();
                        
                     foreach($items as $item){
                        echo "<tr>";
                           echo "<td>$id</td>";
                           echo "<td>$item->name</td>";
                           echo "<td>$item->pnam</td>";
                           echo "<td>$item->ref_no</td>";
                           echo "<td>$item->Quentity</td>";
                           echo "<td>$item->parchases_date</td>";
                           echo "<td>$item->cost</td>";
                           echo "<td>";
                           echo "<div class='btn-group'>";
                           Action_delete($item->id);
                           echo "<form action='invoice_details' method='post'>";
                           echo "<input type='hidden' name='i_id' value='$item->id'>";
                           echo "<input type='submit' class='btn-info' name='show_details' value='Details'>";
                           echo "</form>";
                           echo "</div>";
                           echo "</td>";
                        echo "</tr>";
                        $id++;
                     }
               ?>
               </tbody>

            </table>
         </div>
      </div>
   </div>
</div>            