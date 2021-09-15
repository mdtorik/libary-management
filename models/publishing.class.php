<?php
  

  class Publiser{
    private $pubname;
    
    function __construct($pubname){
        $this->pubname=$pubname;       
    }
    public function save(){
         global $db;
         global $ex;

         
         $db->query("insert into {$ex}Publishers(name)values('$this->pubname')");
        return $db->insert_id;
    }

    public function update($id){
        global $db;
        global $ex;

            
            $sql="update {$ex}Publishers set name='$this->pubname' where id='$id'";
            $db->query($sql);
        
            //file_put_contents("sql.txt",$sql);
            
            return $id;
    }
    public static function delete($id){
      global $db;
      global $ex;
    
    $db->query("delete from {$ex}Publishers where id='$id'");
    }
  }

  class PubliserView{
        public $id;
        public $pubname;
        

        function __construct($id,$pubname){
        $this->id=$id;
        $this->pubname=$pubname;
        }

        public static function get_publishing(){
              global $db;
              global $ex;
        
              $sql="select id,name from {$ex}publishers";
              
              $publishers=$db->query($sql);
              $data=[];
        
              while($publisher=$publishers->fetch_object()){
                $publisher=new PubliserView($publisher->id,$publisher->name);
                array_push($data,$publisher);
              }
              return $data;
            }
    }
?>