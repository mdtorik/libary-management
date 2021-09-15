<?php
   //publish add function
    if(isset($_POST["CtSubmit"])){
      $publish=$_POST["txtPublish"];

        $catagory=new Publiser($publish);
        $catagory->save();
        $message="Successfully Created";
    }

    //publish update function
   if(isset($_POST["pbaSave"])){
      $id=$_POST["txtId"];
      $publishername=$_POST["txtpubname"];
    
      $publish=new Publiser($publishername);
      $publish->update($id);
      
   }
   if(isset($_POST["btnDel"])){   
      $id=$_POST["txtId"];
      Publiser::delete($id);
   }


?>
<!--header section --->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Manage publishir
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

<!---table body show--->
<div class="content">
   <div class="container">     
      <div class="row">
         <div class="col-sm-5">
            <div class="card card-info">            
                     <div class="card-header">
                        <h3 class="card-title">Manage Publishing</h3>
                        <button type="submit" class="btn btn-default float-right" data-toggle="modal" data-target="#Publisher-add">Add Publisher</button>
                        <br><?php echo isset($message)?$message:"" ?>
                     </div>
               <table class="table">                    
               <?php
                    echo "<tr><th>ID</th><th>Name</th><th>Action</th></tr>";
                    $publishs=PubliserView::get_publishing();

                    foreach($publishs as $publish){
                    echo "<tr>";
                    echo "<td>$publish->id</td>";
                    echo "<td>$publish->pubname</td>";
                    echo "<td>";
                        echo "<div class='btn-group'>";
                           Action_delete($publish->id);
                        $json=json_encode(["id"=>"$publish->id","publiname"=>"$publish->pubname"]); 
                        echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#publiser-edit' data-json='$json'><i class='far fa-edit'></i></button>";
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

  <!--publisher add modal-->
<div class="modal" id="Publisher-add">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" class="form-horizontal" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">catagory add</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    <?php echo text_field("Publishirname","txtPublish","Enter name"); ?>                                                                         
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" value="save" class="btn btn-info" name="CtSubmit" />
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--publisher edit modal------>
<div class="modal" id="publiser-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" id="pbedit-form" class="form-horizontal" method="post">
               <div class="modal-header">
               <h4 class="modal-title">Publisher Edit</h4>
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="txtId" id="txtId" />
                  <?php echo text_field("CatagoryName","txtpubname","Enter catagory"); ?>
               </div>
               <div class="modal-footer justify-content-between">
                  <input type="submit" value="Update" class="btn btn-info" name="pbaSave" />
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
         $("#pbedit-form").find("#txtId").val(record.id)
         $("#pbedit-form").find("#txtpubname").val(record.publiname)
      });
   });
</script>
