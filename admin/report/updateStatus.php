<?php
include '../../connection.php';

$id = $_POST['orderId'];

if (isset($_POST['avancer'])) {
   $sql = "SELECT status FROM `orders` WHERE id = '$id'";
   $query = mysqli_query($con, $sql);
   $status = mysqli_fetch_assoc($query)['status'];
   echo $status;


   if ($status == 'confirmation') {
      
      $sql2 = "UPDATE orders SET status = 'preparation' WHERE id = '$id'";
      $query = mysqli_query($con,$sql2);
     
      header("Location: ./");
      exit();

   } else if($status == 'preparation'){
      $sql2 = "UPDATE orders SET status = 'complete' WHERE id = '$id'";
      $query = mysqli_query($con,$sql2);
         header("Location: ./");
         exit();
   } else if($status == 'complete'){
      $sql2 = "UPDATE orders SET status = 'livre' WHERE id = '$id'";
      $query = mysqli_query($con,$sql2);
         header("Location: ./");
         exit();
   }
   




} else if (isset($_POST['annuler'])) {
   $sql = "UPDATE orders SET status = 'annule' WHERE id = '$id'";
   $query = mysqli_query($con, $sql);

   header("Location: ./");
   exit();
}
