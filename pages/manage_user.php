<?php   
  
   if(isset($_POST["btnDel"])){   
      $id=$_POST["txtId"];
      User::delete($id);
   }
   
   if(isset($_POST["btnSaveChange"])){
      $id=$_POST["txtId"];
      $username=$_POST["txtUsername"];
      $password=$_POST["pwdPassword"];
      $repassword=$_POST["pwdRePassword"];
      $role_id=$_POST["cmbRole"];
      $inactive=isset($_POST["ckhInactive"])?0:1;
      
      if($password==$repassword){
      $user=new User($username,$password,$role_id,$inactive);
      $user->update($id);
      }else{
         echo "Password is not matching";
      }
   }
?>
<?php
   if(isset($_POST["btnsubmit"])){

$username=$_POST["txtUsername"];
$role_id=$_POST["cmbRole"];
$password=$_POST["pwdPassword"];
$re_password=$_POST["pwdRePassword"];
$inactive=isset($_POST["ckhInactive"])?0:1;

if($password==$re_password){         
   $user=new User($username,$password,$role_id,$inactive);
   $user->save();
   $message="Successfully Created";
}else{
   $error="Password did not match";
}


}
?>
<!--header section --->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Manage User
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
         <div class="col-sm-9">
            <div class="card card-info">            
                     <div class="card-header">
                        <h3 class="card-title">Manage User</h3>
                        <button type="submit" class="btn btn-default float-right" data-toggle="modal" data-target="#user-create">create User</button>
                     </div>
               <table class="table">                    
               <?php
                     echo "<tr><th>ID</th><th>Name</th><th>Role</th><th>Password</th><th>Status</th></tr>";
                     $users=UserView::get_users();
                     
                     foreach($users as $user){

                     echo "<tr>";
                        echo "<td>$user->id</td>";
                        echo "<td>$user->username</td>";
                        echo "<td>$user->role_name</td>";
                        echo "<td>".md5($user->password)."</td>";
                        echo "<td>";
                           echo "<div class='btn-group'>";
                              Action_delete($user->id);

                              $json=json_encode(["id"=>"$user->id","username"=>"$user->username","password"=>"$user->password","role_id"=>"$user->role_id","inactive"=>"$user->inactive"]);
                              echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#user-edit' data-json='$json'><i class='far fa-edit'></i></button>";
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


<script>
  $(function(){
     
     $(".btn-edit").on("click",function(){

      let record=$(this).data("json");       
      $("#edit-form").find("#txtId").val(record.id)
      $("#edit-form").find("#txtUsername").val(record.username)
      $("#edit-form").find("#pwdPassword").val(record.password)
      $("#edit-form").find("#pwdRePassword").val(record.password)

      $("#edit-form").find("#cmbRole option").each(function(k,v){
         if(v.value==record.role_id){
            $(this).attr("selected","selected")
         }
      });
      if(record.inactive==0){
         $("#edit-form").find("#ckhInactive").attr("checked","checked");
      }else{
         $("#edit-form").find("#ckhInactive").removeAttr("checked");
      }   
     });
  });
</script>
<!---edit modal---->
<div class="modal" id="user-edit">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <form action="#" id="edit-form" class="form-horizontal" method="post">
               <div class="modal-header">
                  <h4 class="modal-title">Edit User</h4>
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            
               <div class="modal-body">      
                                             
                  <?php echo isset($message)?$message:"" ?>
                  <?php echo isset($error)?$error:"" ?>
                  <input type="hidden" name="txtId" id="txtId" />
                  <?php echo text_field("Name","txtUsername","Enter name"); ?>  
                  <?php echo password_field("Password","pwdPassword","Enter password"); ?>   
                  <?php echo password_field("Retype Password","pwdRePassword","Enter password"); ?>           
                  <?php             
                     $roles=$db->query("select id,name from {$ex}roles");                 
                     $roles_arr=[];                      
                     while(list($id,$name)=$roles->fetch_row()){                         
                     $roles_arr[$id]=$name;                       
                     }                                    
                     echo select_box("Role","cmbRole",$roles_arr);
                  ?> 
                  Active <input type="checkbox" name="ckhInactive" id="ckhInactive"/>                                              
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="btnSaveChange" class="btn btn-primary">Save changes</button>
               </div>
            </form>
         </div>
      </div>
   </div>   

<!----create modal--->
<div class="modal" id="user-create">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <form action="#" id="create-form" class="form-horizontal" method="post">
            <div class="modal-header">
               <h4 class="modal-title">Create User</h4>
               <button type="button" class="btn btn-default" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body">      
                                          
               <?php echo isset($message)?$message:"" ?>
                     <?php echo isset($error)?$error:"" ?>

                  <?php echo text_field("Name","txtUsername","Enter name"); ?>  
                  <?php echo password_field("Password","pwdPassword","Enter password"); ?>   
                  <?php echo password_field("Retype Password","pwdRePassword","Enter password"); ?> 
               
                  <?php                       
                  $roles=$db->query("select id,name from {$ex}roles");
                  $roles_arr=array();                      
                  while(list($id,$name)=$roles->fetch_row()){                         
                     $roles_arr[$id]=$name;                       
                  }                    
                  echo select_box("Role","cmbRole",$roles_arr);
               ?>                   
               Active <input type="checkbox" name="ckhInactive" id="ckhInactive"/>                                 
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" name="btnsubmit" class="btn btn-primary">Create Uset</button>
            </div>
         </form>
      </div>
   </div>
</div>
