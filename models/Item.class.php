<?php
  

  class Item{
    private $id;
    private $barcode;
    private $title;
    private $author;
    private $catagory_id;
    private $img_name;
    private $price;
    

    function __construct($barcode,$title,$author,$catagory_id,$img_name,$price){
        $this->barcode=$barcode;
        $this->title=$title;
        $this->author=$author;
        $this->catagory_id=$catagory_id;
        $this->img_name=$img_name;
        $this->price=$price;
        
    }

    public function saveitem(){
         global $db;
         global $ex;

         
         $db->query("insert into {$ex}books(barcode,title,author,catagory_id,img_name,price)values('$this->barcode','$this->title','$this->author','$this->catagory_id','$this->img_name','$this->price')");
        return $db->insert_id;
    }

    public function updateitem($id){
        global $db;
        global $ex;

            
            $sql="update {$ex}books set barcode='$this->barcode',title='$this->title',author='$this->author',catagory_id='$this->catagory_id',img_name='$this->img_name',price='$this->price' where id='$id'";
            $db->query($sql);
        
            //file_put_contents("sql.txt",$sql);
            
            return $id;
    }
    public static function delete($id){
      global $db;
      global $ex;
    
    $db->query("delete from {$ex}books where id='$id'");
    }
  }

  class ItemView{
    public $id;
    public $barcode;
    public $title;
    public $author;
    public $catagory;
    public $price;
    public $img_name;

    function __construct($id,$barcode,$title,$author,$catagory,$price,$img_name){
      $this->id=$id;
      $this->barcode=$barcode;
      $this->title=$title;
      $this->author=$author;
      $this->catagory=$catagory;
      $this->price=$price;
      $this->img_name=$img_name;
    }
    
    public static function get_books($page){
      global $db;
      global $ex;
      
      $total_rs=$db->query("select count(*) from {$ex}books");
      list($total)=$total_rs->fetch_row();
      $per_page=3;
      $top=($page-1)*$per_page;
      $total_page=ceil($total/$per_page);

      $sql="select b.id,b.barcode,b.title,b.author,c.name,b.price,b.img_name from {$ex}books b,{$ex}catagory c where c.id=b.catagory_id order by id limit $top,$per_page";
      $items=$db->query($sql);
      //file_put_contents("sql.txt",$sql);
      $data=[];

      while($item=$items->fetch_object()){
        $item=new ItemView($item->id,$item->barcode,$item->title,$item->author,$item->name,$item->price,$item->img_name);
        array_push($data,$item);
      

      }
      $table=["data"=>$data,"pagination"=>pagination($page,$total_page)];
      return $table;
    }

    public static function get_book(){
      global $db;
      global $ex;
      
      $sql="select b.id,b.barcode,b.title,b.author,c.name,b.price,b.img_name from {$ex}books b,{$ex}catagory c where c.id=b.catagory_id order by id";
      $items=$db->query($sql);
      //file_put_contents("sql.txt",$sql);
      $data=[];

      while($item=$items->fetch_object()){
        $item=new ItemView($item->id,$item->barcode,$item->title,$item->author,$item->name,$item->price,$item->img_name);
        array_push($data,$item);
      }
      return $data;
    }

  }
?>