<?php
  

  class Catagory{
    private $catagoryname;
    
    function __construct($catagoryname){
        $this->catagoryname=$catagoryname;       
    }
    public function savecatagory(){
         global $db;
         global $ex;

         
         $db->query("insert into {$ex}catagory(name)values('$this->catagoryname')");
        return $db->insert_id;
    }

    public function updatecatagory($id){
        global $db;
        global $ex;

            
            $sql="update {$ex}catagory set name='$this->catagoryname' where id='$id'";
            $db->query($sql);
        
            //file_put_contents("sql.txt",$sql);
            
            return $id;
    }
    public static function delete($id){
      global $db;
      global $ex;
    
    $db->query("delete from {$ex}catagory where id='$id'");
    }
  }

  class CatagoryView{
        public $id;
        public $catagoryname;
        

        function __construct($id,$catagoryname){
        $this->id=$id;
        $this->catagoryname=$catagoryname;
        }

        public static function get_catagory(){
              global $db;
              global $ex;
        
              $sql="select id,name from {$ex}catagory";
              
              $catagorys=$db->query($sql);
              $data=[];
        
              while($catagory=$catagorys->fetch_object()){
                $catagory=new CatagoryView($catagory->id,$catagory->name);
                array_push($data,$catagory);
              }
              return $data;
            }
    }
?>