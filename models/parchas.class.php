<?php
  

  class Parchas{
    private $publishers_id;
    private $parchases_date;
    private $ref_no;
    private $parchases_id;
    private $product_id;
    private $Quentity;
    private $cost;
    private $total;
    

    function __construct($publishers_id,$parchases_date,$ref_no,$parchases_id,$product_id,$Quentity,$cost,$total){
      $this->publishers_id=$publishers_id;
      $this->parchases_date=$parchases_date;
      $this->ref_no=$ref_no;
      $this->parchases_id=$parchases_id;
      $this->product_id=$product_id;
      $this->Quentity=$Quentity;
      $this->cost=$cost;
      $this->total=$total;
    }
        
    public function save(){
      global $db;
      global $ex;
      $db->query("insert into {$ex}parchases(publishers_id,parchases_date,ref_no)values('$this->publishers_id','$this->parchases_date','$this->ref_no')");
     return $db->insert_id;
    }
    public function save1(){
        global $db;
        global $ex;
  
        $db->query("insert into {$ex}parchase_details(parchases_id,product_id,Quentity,cost)values('$this->parchases_id','$this->product_id','$this->Quentity','$this->cost')");
       return $db->insert_id;
      }

    public function update($id){
      global $db;
      global $ex;

      $md5=md5($this->password);
      $sql="update {$ex}users set username='$this->username',password='$md5',role_id='$this->role_id',inactive='$this->inactive' where id='$id'";
      $db->query($sql);  
      return $id;
    }

    public static function delete($id){
      global $db;
      global $ex;
      
      $db->query("delete from {$ex}users where id='$id'");
    }
  }

  class ParchasView{
    public $id;
    public $name;
    public $pnam;
    public $ref_no;
    public $Quentity;
    public $parchases_date;
    public $cost;
    public $total;

    function __construct($id,$name,$pnam,$ref_no,$Quentity,$parchases_date,$cost,$total){
        $this->id=$id;
        $this->name=$name;
        $this->pnam=$pnam;
        $this->ref_no=$ref_no;
        $this->Quentity=$Quentity;
        $this->parchases_date=$parchases_date;
        $this->cost=$cost;
        $this->total=$total;
    }
    public static function get_parchases(){
      global $db;
      global $ex;

      $sql="select pb.name,p.name pnam,pa.ref_no,pde.Quentity,pa.parchases_date,pde.cost,pde.total from {$ex}products p,{$ex}parchases pa,{$ex}parchase_details pde,{$ex}publishers pb where pde.publishers_id=pb.id and pa.publishers_id=pb.id and p.id=pde.product_id and pa.id=pde.parchases_id order by name";
      $users=$db->query($sql);        
      $data=[];
        while($user=$users->fetch_object()){
          $user=new ParchasView($user->name,$user->pnam,$user->ref_no,$user->Quentity,$user->parchases_date,$user->cost,$user->total);
          array_push($data,$user);
        }      
        return $data;
    }

    public static function get_parchasess(){
      global $db;
      global $ex;

      $sql="select pb.id,pb.name,p.name pnam,pa.ref_no,pde.Quentity,pa.parchases_date,pde.cost,pde.total from {$ex}products p,{$ex}parchases pa,{$ex}parchase_details pde,{$ex}publishers pb where pde.publishers_id=pb.id and pa.publishers_id=pb.id and p.id=pde.product_id and pa.id=pde.parchases_id order by name";
      $users=$db->query($sql);        
      $data=[];
        while($user=$users->fetch_object()){
          $user=new ParchasView($user->id,$user->name,$user->pnam,$user->ref_no,$user->Quentity,$user->parchases_date,$user->cost,$user->total);
          array_push($data,$user);
        }      
        return $data;
    }

    // public static function get_book(){
    //   global $db;
    //   global $ex;

    //   $sql="select id,barcode,title,author,catagory,price from {$ex}books";
    //   $users=$db->query($sql);
    //   $data=[];

    //   while($user=$users->fetch_object()){
    //     $user=new UserView($user->id,$user->barcode,$user->title,$user->author,$user->catagory,$user->price);
    //     array_push($data,$user);
    //     
    //   }
    //return $data;
    // }
  }
?>