<?php
  //HTTP header file
  header("Content-Type:application/json");

  $type = $_GET['type'];

  switch($type){
    case 'insert' : {

        //SQL

        echo json_encode([
            "status" => 200,
            "message" => "Product added succss."
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
  }
  

?>