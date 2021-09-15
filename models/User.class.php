<?php
  class User{
    private $id;
    private $username;
    private $password;
    private $role_id;
    private $inactive;

    function __construct($username,$password,$role_id,$inactive){
      $this->username=$username;
      $this->password=$password;
      $this->role_id=$role_id;
      $this->inactive=$inactive;
    }
        
    public function save(){
      global $db;
      global $ex;

      $md5=md5($this->password);
      $db->query("insert into {$ex}users(username,password,role_id,inactive)values('$this->username','$md5','$this->role_id','$this->inactive')");
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

  class UserView{
    public $id;
    public $username;
    public $password;
    public $role_id;
    public $role_name;
    public $inactive;

    function __construct($id,$username,$password,$role_id,$role_name,$inactive){
      $this->id=$id;
      $this->username=$username;
      $this->password=$password;
      $this->role_id=$role_id;
      $this->role_name=$role_name;
      $this->inactive=$inactive;
    }
    public static function get_users(){
      global $db;
      global $ex;

      $sql="select u.id,u.username,u.password,u.role_id,r.name role_name,u.inactive from {$ex}users u,{$ex}roles r where r.id=u.role_id order by u.id";
      $users=$db->query($sql);        
      $data=[];
        while($user=$users->fetch_object()){
          $user=new UserView($user->id,$user->username,$user->password,$user->role_id,$user->role_name,$user->inactive);
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