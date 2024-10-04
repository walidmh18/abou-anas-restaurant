<?php 
include '../../connection.php';


if(isset($_POST['save']) && !empty($_POST['id']) && empty($_FILES['image']['name']) && !isset($_POST['delete'])){
   $id = $_POST['id'];
   $fr = $_POST['nomFr'];
   $ar = $_POST['nomAr'];
   $prix = $_POST['prix'];
   $category = $_POST['categoryInp'];
   $sql = "UPDATE plats SET
         name_fr = '$fr',
         name_ar = '$ar',
         price = '$prix',
         category = '$category'
         WHERE id = '$id'";
   mysqli_query($con , $sql);
   header("Location: ./");
         exit();
   
}else if (isset($_FILES['image']) && !isset($_POST['delete'])) {
   
   
   $image_type = $_FILES['image']['type'];

  switch ($image_type) {
   case 'image/png':
      $type = '.png';
      break;
   case 'image/jpg':
      $type = '.jpg';
      break;
   case 'image/jpeg':
      $type = '.jpeg';
      break;    
   case 'image/gif':
      $type = '.gif';
      break;      
   default:
      $type= 'jpg';
      break;
  }


   $_FILES['image']['name'] = time().uniqid(rand()).$type;
   $image_name = 'https://r.vic-enp.com/images/'.$_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $target = "../../images/".basename($_FILES['image']['name']);
   
   $info = getimagesize($_FILES['image']['tmp_name']);
   
   
   if ($info === FALSE) {
      header("Location: ./?status=fail&err=Sorry, an error occurred. Please enter a valid image.");
      
   } else if ($image_size> 3000000) {
      header("Location: index.php?status=fail&err=Sorry, The file is too large.");
      
   } else if (move_uploaded_file($image_tmp_name, $target)) {


      if (isset($_POST['save'])  && empty($_POST['id'])) {

         $fr = $_POST['nomFr'];
         $ar = $_POST['nomAr'];
         $prix = $_POST['prix'];
         $category = $_POST['categoryInp'];
         $sql = "INSERT INTO plats 
               (name_fr,name_ar,price,category, image_address, times_ordered)
               VALUES ('$fr','$ar','$prix','$category','$image_name',0)";
         mysqli_query($con , $sql);
         header("Location: ./");
         exit();
      } else if(isset($_POST['save']) && !empty($_POST['id'])){
         $id = $_POST['id'];


   $fr = $_POST['nomFr'];

         $ar = $_POST['nomAr'];
         $prix = $_POST['prix'];
         $category = $_POST['categoryInp'];
         $sql = "UPDATE plats SET
               image_address = '$image_name',
               name_fr = '$fr',
               name_ar = '$ar',
               price = '$prix',
               category = '$category'
               WHERE id = '$id'";
         mysqli_query($con , $sql);
         
         header("Location: ./");
         exit();
      }
      
      
   }
   else{
      header("Location: index.php?status=fail&err=Sorry, an error occurred. Please try again.");
        
      
   }
}

else if(isset($_POST['delete'])){
   $id = $_POST['id'];
   $sql = "DELETE FROM plats WHERE id = '$id'";
   mysqli_query($con,$sql);
   header("Location: ./");
         exit();
}
