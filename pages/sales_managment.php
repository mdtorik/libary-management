<?php
if(isset($_POST["btnsubmit"])){
$BarCode=$_POST["txtbarcod"];
$Quentity=$_POST["txtqty"];


//$id=0;
    $query=$db->query("select id,barcode,title,price from lib_books where barcode='$BarCode'");
    $row=$query->fetch_object();

    $_SESSION["selse"][0]["id"]=$row->id;
    $_SESSION["selse"][0]["barcode"]=$row->barcode;
    $_SESSION["selse"][0]["name"]=$row->title;
    $_SESSION["selse"][0]["price"]=$row->price;
    $_SESSION["selse"][0]["qty"]=$Quentity;
    $_SESSION["selse"][0]["total"]=$_SESSION["selse"][0]["price"]*$Quentity;

// while(list($id,$barcode,$title,$price)=$query->fetch_row()
}
?>
<style>
.head{
    border: 1px solid gray;
    min-height: 50px;
    width: 90%;
    margin: 0 auto;
    
}
</style>
<div class="head" style="margin-top:10px;">
    <form action="#" method="POST">
        <b>Barcode</b>
        <input type="text" name="txtbarcod">
        <b>Quentity</b>
        <input type="text" name="txtqty">
        <input type="submit" name="btnsubmit" value="Buy">    
    </form>
</div>
<br>
<form action="#" method="POST">
    <div class="head">
        <h3 style="text-align:center;">MS BOOK SHOP <br> BUBT Book Complex Dhaka-1250</h3>
        <p style="text-align:center;">we are alaways rady to help you</p>
        <div>
        Customar name : <input type="text"> Address : <input type="text"> Date : <input type="text"><br> <br>
        phone : <input type="text"> Payment : <input type="radio"> Cash <input type="radio"> Bkash <input type="radio"> Card <input type="radio"> Rocket
           
        </div>
        <br>
        <div>
            <table class="table">
                <tr><th>ID</th><th>Barcode</th><th>Name</th><th>qty</th><th>Rate</th><th>Total</th></tr>
                <?php
                // if(isset($_POST["btnsubmit"])){
                //     $BarCode=$_POST["txtbarcod"];

                // }
                // if(is_array($_SESSION["sales"])){
                //     $query=$db->query("select id,barcode,title,price from lib_books where barcode='$BarCode'");
                //     while(list($id,$barcode,$title,$price)=$query->fetch_row()){
                    
                    foreach($_SESSION["selse"] as $k=>$v){
                    echo "<tr>";
                    echo "<td>$v[id]</td>";
                    echo "<td>$v[barcode]</td>";
                    echo "<td>$v[name]</td>";
                    echo "<td>$v[qty]</td>";
                    echo "<td>$v[price]</td>";
                    echo "<td>$v[total]</td>";
                    echo "</tr>";
                
                }
                ?>
                <tr>
                    <td colspan="5">Total amount</td>
                    <td>=<?php echo $v["total"]; ?></td>
                </tr>
            </table>
        </div>
        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
    </div>    
</form>