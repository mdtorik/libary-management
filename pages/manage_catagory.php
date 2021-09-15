<?php
   //catagory add function
    if(isset($_POST["CtSubmit"])){
      $catagoryname=$_POST["txtUsername"];

        $catagory=new Catagory($catagoryname);
        $catagory->savecatagory();
        $message="Successfully Created";
    }

    //catagory update function
   if(isset($_POST["CtaSave"])){
      $id=$_POST["txtId"];
      $catagoryname=$_POST["txtcataname"];
    
      $catgory=new Catagory($catagoryname);
      $catgory->updatecatagory($id);
      
   }
   if(isset($_POST["btnDel"])){   
      $id=$_POST["txtId"];
      Catagory::delete($id);
   }


?>
<!--header section --->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Manage Catagory
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
         <div class="col-sm-5">
            <div class="card card-info">            
                     <div class="card-header">
                        <h3 class="card-title">Manage User</h3>
                        <!-- <button type="submit" class="btn btn-default float-right" data-toggle="modal" data-target="#user-create">create User</button> -->
                        <br><?php echo isset($message)?$message:"" ?>
                     </div>
               <table class="table">                    
               <?php
                    echo "<tr><th>ID</th><th>Name</th><th>Action</th></tr>";
                    $catagorys=CatagoryView::get_catagory();

                    foreach($catagorys as $catagory){
                    echo "<tr>";
                    echo "<td>$catagory->id</td>";
                    echo "<td>$catagory->catagoryname</td>";
                    echo "<td>";
                        echo "<div class='btn-group'>";
                           Action_delete($catagory->id);
                        $json=json_encode(["id"=>"$catagory->id","catagoryname"=>"$catagory->catagoryname"]);
                        //print_r($json);  
                        echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#catgory-edit' data-json='$json'><i class='far fa-edit'></i></button>";
                        echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                  }
               ?>                  
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

  <!--catagory add modal-->
<div class="modal" id="catagory-add">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" id="edit-form" class="form-horizontal" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">catagory add</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    <?php echo text_field("CatagoryName","txtUsername","Enter catagory"); ?>                                                                         
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" value="save" class="btn btn-info" name="CtSubmit" />
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--catagory edit modal------>
<div class="modal" id="catgory-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" id="ctedit-form" class="form-horizontal" method="post">
               <div class="modal-header">
               <h4 class="modal-title">catagory add</h4>
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="txtId" id="txtId" />
                  <?php echo text_field("CatagoryName","txtcataname","Enter catagory"); ?>
               </div>
               <div class="modal-footer justify-content-between">
                  <input type="submit" value="Update" class="btn btn-info" name="CtaSave" />
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
               </div>
            </form>
        </div>
    </div>
</div>
<script>
   $(function(){
      $(".btn-edit").on("click",function(){
         let record=$(this).data("json");
         $("#ctedit-form").find("#txtId").val(record.id)
         $("#ctedit-form").find("#txtcataname").val(record.catagoryname)
      });
   });
</script>
