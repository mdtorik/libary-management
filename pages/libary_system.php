
<div class="content">   
  <div class="container">     
    <div class="row" style="margin-top:10px;">
      <?php
                              

          $items=ItemView::get_book(); 
          foreach($items as $item){
      ?>
        <div class="col-3"style="margin-bottom:10px;">
        <div class="col txts" style="border-radius:5px; border:2px; background-color:#008081;">
          <div class="row txts">
                    
                    <div class="col">
                      <img src="images\<?php echo $item->img_name?>"class="img-fluid" style="width:100%; height:150px";>
                    </div>
          </div>
          <div class="card-header">
                <h4><b><?php echo "ISBN : ".$item->barcode?></b></h4>
          </div>

          <div class="row">
                <div class="col">
                  <b><?php echo "title : ".$item->title?></b><br>
                  <?php echo "Author : ".$item->author?><br>
                  <?php echo"Catagory : ". $item->catagory?><br>
                  <?php echo"Price : ". $item->price?><br>
                  </div>
                
              </div>
              </div>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
