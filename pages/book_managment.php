<?php
   if(isset($_POST["btnDel"])){   
      $id=$_POST["txtId"];
      Item::delete($id);
   }

   if(isset($_POST["update"])){
      $id=$_POST["txtId"];
      $barcod=$_POST["txtcode"];
      $title=$_POST["txtbook"];
      $author=$_POST["txtautor"];
      $catagory=$_POST["cmbCatagory"];
      $price=$_POST["txtprice"];
      $file_name=$_POST["file"];
      //print_r($file_name);
      $item=new Item($barcod,$title,$author,$catagory,$file_name,$price);      
      $item->updateitem($id);      
   }
?>

<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               BOOK MANAGMENT
            </h1>
         </div>
         <div class="col">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manag Book</li>
            </ol>
         </div>
      </div>
   </div>
</div>


<div class="content">   
   <div class="container">     
      <div class="row">
         <div class="col-sm-11">            
            <!-- <form action="#" class="form-horizontal" method="post"> -->
               <div class="card card-info">             
                  <div class="card-header">
                     <h3 class="card-title">Book Managment</h3>
                  </div>

                  <div class="card-body">
                     <table class="table table-striped">
                        <?php 

                          echo "<tr><th>ID</th><th>BarCode</th><th>title</th><th>Author</th><th>Catagory</th><th>price</th><th>picture</th><th>Action</th></tr>";
                          $page=isset($_GET["p"])?$_GET["p"]:1;

                          $items=ItemView::get_books($page);
                           //print_r($items);
                           $id=1;
                           foreach($items["data"] as $item){
                              //while($item=$items["data"]->fetch_object()){
                              echo "<tr>";
                              echo "<td>$item->id</td>";
                              echo "<td>$item->barcode</td>";
                              echo "<td>$item->title</td>";
                              echo "<td>$item->author</td>";
                              echo "<td>$item->catagory</td>";
                              echo "<td>$item->price</td>";
                              echo "<td><img src='images/$item->img_name' style='width:50px;height:50px;' alt='not found'></td>";
                              echo "<td>";
                                 echo "<div class='btn-group'>";
                                 Action_delete($item->id);

                                    $json=json_encode(["id"=>"$item->id","barcode"=>"$item->barcode","title"=>"$item->title","author"=>"$item->author","catagory"=>"$item->catagory","img_name"=>"$item->img_name","price"=>"$item->price"]);
                                    //print_r($json);
                                    echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#item-edit' data-json='$json'><i class='far fa-edit'></i></button>";
                                 echo "</div>";
                              echo "</td>";
                              
                              echo "</tr>";
                           }
                        ?>
                     </table>
                     <?php 
                     echo $items["pagination"];
                   ?>                   
                  </div>                      
               </div>
            <!-- </form>              -->
         </div>  
      </div>  
   </div>
</div>


<script>
  $(function(){
      $(".btn-edit").on("click",function(){
         let record=$(this).data("json");                
         $("#edit-form").find("#txtId").val(record.id)
         $("#edit-form").find("#txtcode").val(record.barcode)
         $("#edit-form").find("#txtbook").val(record.title)
         $("#edit-form").find("#txtautor").val(record.author)
         $("#edit-form").find("#cmbCatagory option").each(function(k,v){
            if(v.value==record.catagory){
               $(this).attr("selected","selected")
            }
         });
         $("#edit-form").find("#txtprice").val(record.price)
         $("#edit-form").find("#file").val(record.img_name)
      });
  });
</script>


<!--edit modal------>
<div class="modal" id="item-edit">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <form action="#" id="edit-form" class="form-horizontal" method="post">
            <div class="modal-header">
               <h4 class="modal-title">Edit Item</h4>
               <button type="button" class="btn btn-default" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         
            <div class="modal-body">                                   
                  <?php echo isset($message)?$message:"" ?>
                  <input type="hidden" name="txtId" id="txtId" />
                  <?php echo text_field("BarCode","txtcode","Enter Code"); ?>  
                  <?php echo text_field("Book name","txtbook","Enter book name"); ?>  
                  <?php echo text_field("Author","txtautor","Enter author name"); ?>                  
                  <?php                       
                  $catagorys=$db->query("select id,name from {$ex}catagory");
                  $catagorys_arr=array();                      
                  while(list($id,$name)=$catagorys->fetch_row()){                         
                     $catagorys_arr[$id]=$name;                       
                  }                    
                  echo select_box("Catagory","cmbCatagory",$catagorys_arr);
                  ?>
                  <?php echo text_field("price","txtprice","Enter price"); ?>
                  <label>Image upload</label> 
                  <input type="file" name="file" id="file" accept="image/*" />                                              
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
