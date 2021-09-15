<div class="content-wrapper">
    
    <?php
       
      if(isset($_GET["page"])){

         $page=$_GET["page"];

         if($page=="book-add"){              
            include("pages/book_add.php");
         }elseif($page=="manage-contact"){
            include("pages/book_managment.php");
         }elseif($page=="create-user"){
            include("pages/create_user.php");
         }elseif($page=="manage-user"){
            include("pages/manage_user.php");
         }elseif($page=="contact"){
            include("pages/contact.php");
         }elseif($page=="sales-managment"){
         include("pages/sales_managment.php");
         }elseif($page=="manage-catagory"){
            include("pages/manage_catagory.php");
         }elseif($page=="publishing-company"){
            include("pages/publishing.php");
         }elseif($page=="parchase-table"){
            include("pages/parchases.php");
         }elseif($page=="parchase-managment"){
            include("pages/parchases_manag.php");
         }elseif($page=="invoice_details"){
            include("pages/invoice_details.php");
         }
         
      }else{
         
         include("pages/libary_system.php");
            
      }
    
    ?>
    
</div>