<?php


include '../connection.php';

echo '<pre>';
print_r(json_decode($_POST['cart']));
echo '</pre>';

$cart = $_POST['cart'];
$type = $_POST['type'];
$total = $_POST['total'];
$client = $_POST['client'];
$currTime = time();

// echo $cart,$type,$total,'confirmation',$currTime,$client;

$sql = "INSERT INTO `orders` 
      (plats,type,total,status,time,client)
      VALUES('$cart','$type','$total','confirmation','$currTime','$client')";

// $response = mysqli_query($con,$sql);


// echo ;
// echo '<pre>';
// print_r(json_decode($_POST['cart'])[0]->id);
// echo '</pre>';

foreach (json_decode($_POST['cart']) as $e) {
   if ($e->type == 'plat') {
      $id = $e->id;
      $query = 
      "SELECT times_ordered 
      FROM `plats` 
      WHERE id='$id'";
      $res = mysqli_fetch_assoc(mysqli_query($con,$query))['times_ordered'];

      $newOrdered = $res + $e->qty;

      $q = 
      "UPDATE plats
      SET times_ordered='$newOrdered'
      WHERE id = $e->id";

      $r= mysqli_query($con,$q);

      
   } else if($e->type == 'pack'){
      $id = $e->id;
      $query = 
      "SELECT times_ordered 
      FROM `packs` 
      WHERE id='$id'";
      $res = mysqli_fetch_assoc(mysqli_query($con,$query))['times_ordered'];

      $newOrdered = $res + $e->qty;

      $q = 
      "UPDATE plats
      SET times_ordered='$newOrdered'
      WHERE id = $e->id";

      $r= mysqli_query($con,$q);

   }
}

// header("Location: ./success");

?>