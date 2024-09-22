<?php
include "../../connection.php";




function time_elapsed_string($datetime, $full = false)
{
   $now = new DateTime;
   $ago = new DateTime(("@" . $datetime));
   $diff = $now->diff($ago);

   $diff->w = floor($diff->d / 7);
   $diff->d -= $diff->w * 7;

   $string = array(
      'y' => 'an',
      'm' => 'mois',
      'w' => 'semaine',
      'd' => 'jour',
      'h' => 'heure',
      'i' => 'minute',
      's' => 'seconde',
   );
   foreach ($string as $k => &$v) {
      if ($diff->$k) {
         $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
         unset($string[$k]);
      }
   }

   if (!$full) $string = array_slice($string, 0, 1);
   return $string ? "Il y'a " . implode(', ', $string) : 'just now';
}

$today = strtotime("today") - 3600;










$maxarr = [];
$ARR = [];
$max = isset($_POST['maxId']) ? $_POST['maxId'] : 0;





$sql = "SELECT * FROM `orders` WHERE id > '$max' LIMIT 30";
$response = mysqli_query($con, $sql);

while ($item = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
$client = $item['client'];
$time = time_elapsed_string($item['time']);
$order = $item['plats'];
$total = $item['total'];
$type = $item['type'];
$status = $item['status'];



$msg = [
   'id'=> $item['id'],
   'client'=>$client,
   'time'=>$time,
   'order' => $order,
   'total' => $total,
   'type' => $type,
   'status' => $status
];

array_push($ARR,$msg);
array_push($maxarr,$item['id']);

// echo $order . '<br>';

}
$maximum = isset($maxarr[0]) ? end($maxarr) : $max;
$final = [$maximum,$ARR];

echo json_encode($final);

?>