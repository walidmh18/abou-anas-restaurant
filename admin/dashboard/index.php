<!DOCTYPE html>
<html lang="en">

<head>
   <?php
   include '../../head.php';
   include '../../connection.php';
   ?>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tableau de bord</title>
   <link rel="stylesheet" href="./style.css">
</head>

<body>


   <?php include '../sideMenu.php'; ?>

   <div class="body">
      <div class="title">
         <h1>Tableau de bord</h1>
         <p class="date">Jeudi, 12 Septembre 2024</p>
      </div>
      <div class="container">
         <div class="left">
            <?php

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

            $today = strtotime("today");
            $sql = "SELECT * FROM `orders` WHERE time >= $today";
            $res = mysqli_query($con, $sql);
            // echo '<pre>';
            // print_r($res);
            // echo '</pre>';
            $n_of_orders = $res->num_rows;
            $totalRevenue = 0;
            $platsTotal = 0;
            $types = ['sp' => 0, 'emp' => 0, 'liv' => 0];


            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
               $totalRevenue += $row['total'];
               $facture = json_decode($row['plats']);

               foreach ($facture as $el) {

                  if ($el->type != 'pack') {
                     $platsTotal += $el->qty;
                  } else {
                     $pack_id = $el->id;
                     $q = "SELECT * FROM `packs` WHERE id = '$pack_id'";
                     $r = mysqli_fetch_array(mysqli_query($con, $q), MYSQLI_ASSOC);
                     foreach (json_decode($r['contents']) as $x => $y) {
                        $platsTotal += $y;
                     }
                  }
               }
               // echo $el->type;

               if ($row['type'] == 'livraison') {
                  $types['liv']++;
               } else if ($row['type'] == 'sur place') {
                  $types['sp']++;
               } else if ($row['type'] == 'emporter') {
                  $types['emp']++;
               }
            }



            ?>
            <div class="stats">

               <div class="stat">
                  <div class="icon"><i class="fa-regular fa-circle-dollar"></i></div>
                  <h3><?= $totalRevenue ?> DZD</h3>
                  <p>total revenue</p>
               </div>
               <div class="stat">
                  <div class="icon"><i class=" fa-regular fa-utensils"></i></div>
                  <h3><?= $platsTotal ?></h3>
                  <p>Nombre des plats</p>
               </div>
               <div class="stat">
                  <div class="icon"><i class="fa-regular fa-list-ul"></i></div>
                  <h3><?= $n_of_orders ?></h3>
                  <p>Commandes totales</p>
               </div>
            </div>
            <div class="rapport-jour">
               <div class="header">
                  <h2>Rapport de jour</h2>
               </div>


               <table class="table">
                  <tr class="tableHeader">
                     <th>Client</th>
                     <th>Temps</th>
                     <th>Articles</th>
                     <th>Total</th>
                     <th>Type</th>
                     <th>Statu</th>
                  </tr>

                  <?php
                  $sql = "SELECT * FROM `orders` WHERE time >= $today";
                  $response = mysqli_query($con, $sql);

                  while ($item = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
                  ?>
                     <tr class="tableElement">
                        <td class="client"><?= $item['client'] ?></td>
                        <td class="temps"><?= time_elapsed_string($item['time']) ?></td>
                        <td class="orderSum">

                           <ul>
                              <?php
                              foreach (json_decode($item['plats']) as $i) {
                                 if ($i->type != 'sandwich') {
                              ?>
                                    <li><?= $i->qty ?>* <?= $i->name->fr ?></li>
                                 <?php
                                 } else {
                                    // {"id":"0","type":"sandwich","price":600,"ings":[{"name":"Royal dinde","qty":"4"}],"add":[],"qty":1}

                                 ?>
                                    <li>
                                       <?= $i->qty ?> * Sandwich
                                    </li>

                                    <?php

                                    foreach ($i->ings as $value) {
                                    ?>
                                       <li class="ingredient"><?= $value->qty ?> *<?= $value->name ?></li>
                                    <?php
                                    }

                                    foreach ($i->add as $value) {
                                    ?>
                                       <li class="ingredient"><?= $value ?></li>
                                    <?php
                                    }

                                    ?>
                              <?php
                                 }
                              }
                              ?>
                           </ul>

                        </td>
                        <td class="total"><?= $item['total'] ?> DA</td>
                        <td class="type"><?= $item['type'] ?></td>
                        <td class="statu">
                           <p class="<?= $item['status'] ?>"><?= $item['status'] ?></p>
                        </td>
                     </tr>
                  <?php
                  }


                  ?>

               </table>
            </div>
         </div>
         <div class="right">
            <div class="mostOrdered">
               <div class="header">
                  <h2>Most Ordered</h2>
               </div>
               <div class="itemsContainer">

                  <?php


                  $sqlQ = "SELECT * FROM `plats` ORDER BY times_ordered LIMIT 3";
                  $aaa = mysqli_query($con, $sqlQ);

                  while ($result = mysqli_fetch_array($aaa, MYSQLI_ASSOC)) {
                     $img = $result['image_address'];
                     $name = $result['name_fr'];
                     $orders = $result['times_ordered'];

                  ?>

                     <div class="item">
                        <img src="<?= $img ?>" alt="">
                        <div class="info">
                           <p class="name"><?= $name ?></p>
                           <p class="qty"><?= $orders ?> dishes</p>

                        </div>
                     </div>

                  <?php
                  }

                  ?>

                  <!-- <div class="item">
                     <img src="../../images/pack.png" alt="">
                     <div class="info">
                        <p class="name">pack</p>
                        <p class="qty">200 dishes</p>

                     </div>
                  </div>
                  <div class="item">
                     <img src="../../images/pack.png" alt="">
                     <div class="info">
                        <p class="name">pack</p>
                        <p class="qty">200 dishes</p>

                     </div>
                  </div> -->
               </div>
               <a href="./mostOrdered.php" class="voirTous">Voir tous</a>
            </div>
            <div class="mostType">
               <div class="header">
                  <h2>Most Type of order</h2>
               </div>
               <div class="container">
                  <div class="progressContainer">
                     <div class="livraison" data-progress="20deg" style="background: conic-gradient(#65B0F6 <?= ($types['liv'] / $n_of_orders) * 360 ?>deg,#444444 0deg);">
                        <div class="start">
                           <div></div>
                        </div>
                        <div class="finish" style="rotate:<?= ($types['liv'] / $n_of_orders) * 360 ?>deg;">
                           <div></div>
                        </div>
                     </div>
                     <div class="emporter" data-progress="70deg" style="background: conic-gradient(#FFB572 <?= ($types['emp'] / $n_of_orders) * 360 ?>deg,#3a3a3a 0deg);">
                        <div class="start">
                           <div></div>
                        </div>
                        <div class="finish" style="rotate:<?= ($types['emp'] / $n_of_orders) * 360 ?>deg;">
                           <div></div>
                        </div>
                     </div>
                     <div class="surplace" data-progress="50deg" style="background: conic-gradient(#FF7CA3 <?= ($types['sp'] / $n_of_orders) * 360 ?>deg,#444444 0deg);">
                        <div class="start">
                           <div></div>
                        </div>
                        <div class="finish" style="rotate:<?= ($types['sp'] / $n_of_orders) * 360 ?>deg;">
                           <div></div>
                        </div>
                     </div>
                     <div class="empty"></div>
                     <div class="empty2"></div>
                  </div>
                  <div class="key">
                     <div>
                        <div style="background: #FFB572;"></div>
                        <p>Emporter</p>
                     </div>
                     <div>
                        <div style="background:#65B0F6;"></div>
                        <p>Livraison</p>
                     </div>
                     <div>
                        <div style="background: #FF7CA3 ;"></div>
                        <p>A table</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>





</body>

</html>