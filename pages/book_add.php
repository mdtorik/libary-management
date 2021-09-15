<style>
.txtcolor{
   color:white;
}

</style>
<?php
   if(isset($_POST["btnSubmit"])){
      
       $barcode=$_POST["txtcode"];
       $title=$_POST["txtbook"];
       $author=$_POST["txtautor"];
       $catagory=$_POST["cmbCatagory"];
       $price=$_POST["txtprice"];

       $directory="images/";
       $file_name=$_FILES["file"]["name"];
       $file_tmp_name=$_FILES["file"]["tmp_name"];
       
       move_uploaded_file($file_tmp_name,$directory.$file_name);

         $item=new Item($barcode,$title,$author,$catagory,$file_name,$price);
         //print_r($item);
         $item->saveitem();

          $message="Successfully Created";
   }
  
?>

<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               ADD BOOK FROM
            </h1>
         </div>
         <div class="col">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create User</li>
            </ol>
         </div>
      </div>
   </div>
</div>

<div class="content">  
   <div class="container">     
      <div class="row">
         <div class="col-sm-6">            
            <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
               <div class="card card-info">              
                  <div class="card-header">
                     <h3 class="card-title">Book Registation </h3>
                  </div>
                  <div class="card-body" style="background-color:#008081;">              
                     <?php echo isset($message)?$message:"" ?>
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
                     <input type="file" name="file" id="file" accept="image/*" />                                    
                  </div>
                  <div class="card-footer" style="background-color:#008081; border-top: 2px solid white;">
                     <input type="submit" value="Submit" class="btn btn-info" name="btnSubmit" />
                     <button type="submit" class="btn btn-default float-right">Cancel</button>
                  </div>               
               </div>
            </form>             
         </div>
         <div class="col-sm-6">
            <img src="img\lib10.jpg">
         </div> 
      </div>   
   </div>
</div>