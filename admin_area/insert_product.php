<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_categories=$_POST['product_categories'];
    $product_sellers=$_POST['product_sellers'];
    $product_price=$_POST['product_price'];
    $product_status='true';


    //access images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];
// access image tmp_name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    //checking empty condition
    // Checking empty condition
if(empty($product_title) || empty($description) || empty($product_keywords) || empty($product_categories) || empty($product_sellers) || empty($product_price) || empty($product_image1) || empty($product_image2) || empty($product_image3)){
    echo "<script>alert('Please fill all the available fields')</script>";
    exit();
}
else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        //insert_query
        $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, category_id, seller_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('" . mysqli_real_escape_string($con, $product_title) . "','" . mysqli_real_escape_string($con, $description) . "','" . mysqli_real_escape_string($con, $product_keywords) . "','" . mysqli_real_escape_string($con, $product_categories) . "','" . mysqli_real_escape_string($con, $product_sellers) . "','" . mysqli_real_escape_string($con, $product_image1) . "','" . mysqli_real_escape_string($con, $product_image2) . "','" . mysqli_real_escape_string($con, $product_image3) . "','" . mysqli_real_escape_string($con, $product_price) . "', NOW(), '$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!--bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <!--font awesome link --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!--cs file-->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center mt-3">Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
                <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
                <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
                <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-select">
                <option value="">Select a Category</option>
                <?php
                    $select_query="Select * from `categories`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                ?>
               
               
                </select>
            </div>

            <!--sellers-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_sellers" id="" class="form-select">
                <option value="">Select a Seller</option>
                <?php
                    $select_query="Select * from `sellers`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $seller_title=$row['seller_title'];
                        $seller_id=$row['seller_id'];
                        echo "<option value='$seller_id'>$seller_title</option>";
                    }
                ?>
               
                </select>
            </div>
                
                <!--Image 1-->
                <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"  required="required">
            </div>
                <!--Image 2-->
                <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"  required="required">
            </div>   
               <!--Image 3-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"  required="required">
            </div>

             <!--Price-->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

             <!--insert button-->
             <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>

        </form>
    </div>
    
</body>
</html>