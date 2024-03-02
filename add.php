<?php
session_start();
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["name"];
    $price=$_POST["price"];
    $description =$_POST["description"];
    if(isset($_FILES["image"])){
        $target_directory="./image";
        $image=$target_directory.basename($_FILES["image"]["name"]);
        $imageFileType=strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
        $check=getimagesize($_FILES["image"]["tmp_name"]);
        if($check!==false){
            $allowed_formats=["jpg","jpeg","png"];
            if(in_array($imageFileType,$allowed_formats)){
                if(move_uploaded_file($_FILES["image"]["tmp_name"],$image)){
                    $query="INSERT INTO cart(name,price,description,image) values('$name','$price','$description','$image')";
                    if(mysqli_query($conn,$query)){
                        echo '<script>alert("product added");</script>';
                    }
                }
            }
        }
    }
}
?>                  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add products</title>
</head>
<body class="bg-secondary">
    <div class="container-fluid p-5">
        <h1 class="text-centre">Add product</h1>
        <form action="add.php"method="POST" enctype="multipart/form-data"><br>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div><br>
        <div class="form-group">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price">
        </div><br>
        <div class="form-group">
            <label for="description">description:</label>
            <textarea class="form-control" id="description" name="description" row="3"></textarea>
        </div><br>
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control" id="name" name="image">
        </div><br>
        <button type="submit" class="btn btn-success">Add product</button>
        
    
</body>
</html>