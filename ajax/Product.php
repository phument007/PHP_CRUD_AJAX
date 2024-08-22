<?php
  //HTTP header file
  header("Content-Type:application/json");
  $conn = mysqli_connect("localhost:3306","root","","php_ajax");

  $type = $_GET['type'];

  switch($type){

    case "select" : {


      $search = $_GET['search_items'];

      $page = $_GET['page'];

      $offset = ($page - 1) * 7;



      $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$search%' LIMIT 7 OFFSET $offset ";
      $result = mysqli_query($conn,$sql);
      $data = [];
      while($row=mysqli_fetch_assoc($result)){
        $data[] = $row;
      }

      /*data = [
         [
           'id' => 1,
           'name' => 'Product 1',
           'price' => 100,
           'qty' => 10,
           'image' => 'kaka.jpg,
         ],
         [
           'id' => 1,
           'name' => 'Product 1',
           'price' => 100,
           'qty' => 10,
           'image' => 'kaka.jpg,
         ],

      ]
      */

      $sql = "SELECT * FROM `products`  WHERE `name` LIKE '%$search%' ";
      $result = mysqli_query($conn,$sql);
      $record = mysqli_num_rows($result);  //20  / 7 = 2.2
      $totalPage = ceil($record / 7);




      echo json_encode([
        'status' => 200,
        'data' => $data,
        'record' => $record,
        'totalPage' => $totalPage,
        'currentPage' => $page,
        'message' => "Select product success",
      ]);
      break;
    }

    case 'insert' : {

        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $image = $_POST['image_name'];
        
        $sql = "INSERT INTO `products`(`name`, `price`, `qty`, `image`) 
        VALUES ('$name','$price','$qty','$image')";

        mysqli_query($conn,$sql);

        $tempDir = "../uploads/temp/$image";
        $imageDir = "../uploads/images/$image";

        if(file_exists($tempDir)){
          copy($tempDir,$imageDir);
          unlink($tempDir);
        }

        echo json_encode([
            "status" => 200,
            "message" => "Product added succssfully."
        ]);
        break;
    }
    
    case 'upload' : {
        $file_name = $_FILES['image']['name'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        //var img = kaka.jpg
        //234544.jpg
        $imageName = rand(0,999999999) .'.'. pathinfo($file_name,PATHINFO_EXTENSION);
        // 034534432.jpg

        //upload 
        $imageDir = "../uploads/temp/$imageName";
        move_uploaded_file($file_tmp,$imageDir);
       

         echo json_encode([
            "status" => 200,
            "img" => $imageName,
            "message" => "Upload  succss."
        ]);


        break;
    }
    case 'cancel' : {
       $image = $_POST['image_name'];
       $imageDir = "../uploads/temp/$image";
       if(file_exists($imageDir)){
          unlink($imageDir);
          echo json_encode([
             'status' => 200,
             'message' => 'Cancel image success',
          ]);
       }
      
       break;
    }

    case 'delete' : {
      $id = $_POST['product_id'];
      $image = $_POST['image_name'];
      $sql = "DELETE FROM `products` WHERE `id` = $id";
      mysqli_query($conn,$sql);

      if(file_exists("../uploads/images/$image")){
        unlink("../uploads/images/$image");
      }
      echo json_encode([
        'status' => 200,
        'message' => 'Delete product success',
      ]);
      break;
    }

    case 'edit' : {
      $id = $_POST['product_id'];
      $sql = "SELECT * FROM `products` WHERE id = $id";
      $result = mysqli_query($conn,$sql);

      $row = mysqli_fetch_assoc($result);
      echo json_encode([
        'status' => 200,
        'data' => $row,
        'message' => 'Product Found.',
      ]);
      break;
    }

    case 'update' : {
      $id = $_POST['product_id'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];

      if(isset($_POST['image_name'])){
         $image = $_POST['image_name'];
         $old_image = $_POST['old_image'];
         $tempDir = "../uploads/temp/$image";
         $saveDir = "../uploads/images/$image";
         if(file_exists($tempDir)){
            copy($tempDir,$saveDir);
            unlink($tempDir);
         }

         if(file_exists("../uploads/images/$old_image")){
            unlink("../uploads/images/$old_image");
         }
      }else{
         $image = $_POST['old_image'];
      }

      $sql = "UPDATE `products` SET `name`='$name', `price`='$price', `qty`='$qty', `image`='$image' WHERE `id` = $id";
      mysqli_query($conn,$sql);

      echo json_encode([
        'status' => 200,
        'message' => 'Update product success',
      ]);
      break;
    }
  }
  

?>