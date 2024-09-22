<?php

include '../../connection.php';

if (isset($_POST['save'])) {
   $fr = $_POST['nomFr'];
   $ar = $_POST['nomAr'];

   if (empty($_POST['idInp'])) {
      $sql = "INSERT INTO categories (name_fr,name_ar,tartib) VALUES ('$fr','$ar',1)";
      mysqli_query($con,$sql);
      header("Location: ./categories.php");
   } else {
      $id = $_POST['idInp'];
      $sql = "UPDATE categories SET name_fr = '$fr', name_ar = '$ar' WHERE id = '$id'";
      mysqli_query($con,$sql);
      header("Location: ./categories.php");
   }
} else if(isset($_POST['delete'])){
      $id = $_POST['idInp'];
      $sql = "DELETE FROM categories WHERE id = '$id'";
      mysqli_query($con,$sql);
      header("Location: ./categories.php");
}
?>