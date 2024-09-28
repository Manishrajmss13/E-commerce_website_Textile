<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_seller'])){
        $seller_title=$_POST['seller_title'];

        //select data from db
        $select_query="Select * from `sellers` where seller_title='$seller_title'";
        $result_select=mysqli_query($con,$select_query);
        $number=mysqli_num_rows($result_select);
        if($number>0){
            echo "<script>alert('This seller is present inside the database')</script>";
        }else{
            
        $insert_query="insert into `sellers` (seller_title) values ('$seller_title')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Seller has been inserted successfully')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Sellers</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="seller_title" placeholder="Insert Seller" aria-label="Sellers" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2">
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_seller" value="Insert Seller" aria-label="Username" aria-describedby="basic-addon1">
</div>
</form>  