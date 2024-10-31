<?php session_start();
if (!isset($_SESSION['login'])) {
header("Location: ../login?err=3");
   exit();
}


function dateToFrench($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
?>
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
   <link rel="stylesheet" href="../dashboard/style.css">
   <link rel="stylesheet" href="./style.css">

   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


   <style>
      .sideMenu .rap{
         background:var(--d1);
      }
   </style>
</head>

<body>


   <?php include '../sideMenu.php'; ?>

   <div class="body">
      <div class="title">
         <h1>Rapport</h1>
         <p class="date"><?= dateToFrench("now" ,"l j F Y"); ?></p>

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







            ?>

            <div class="rapport-jour">


               <div class="tableContainer">

                  <table class="table" id="ordersTable">
                     <tr class="tableHeader" id="tableHeader">
                        <th>Client</th>
                        <th>Temps</th>
                        <th>Articles</th>
                        <th>Total</th>
                        <th>Type</th>
                        <th>Statu</th>
                     </tr>

                     <section id="test"></section>

                     <script>
                        $(document).ready(function() {


                           let maxId = 0

                           setInterval(() => {
                              // console.log(a)
                              $.ajax({
                                 type: 'POST',
                                 url: './getOrders.php',
                                 data: {
                                    // grp:grp,
                                    maxId: maxId

                                 },
                                 dataType: 'html',
                                 success: function(data) {
                                    let array = JSON.parse(data)
                                    maxId = array[0]
                                    array[1].forEach(el => {
                                       let order = JSON.parse(el.order);
                                       let out = ''

                                       function ordear() {
                                          $.each(order, function(key, value) {
                                             if (value.type != 'sandwich') {
                                                out = out.concat(`<li>${value.qty}x ${value.name.fr}</li>`)
                                             } else {
                                                out = out.concat(`<li>${value.qty}x sandwich</li>`)
                                                $.each(value.ings, function(a, b) {
                                                   if (b.qty > 0) {
                                                      out = out.concat(`<li class="ingredient">${b.qty}x ${b.name}</li>`)

                                                   }
                                                })
                                                $.each(value.add, function(a, b) {
                                                   out = out.concat(`<li class="ingredient">${b}</li>`)
                                                })
                                             }
                                          })
                                          return out;
                                       }
                                       $('#tableHeader').after(`<tr id="${el.id}" class="tableElement">
                                       <td class="client">${el.client}</td>
                                       <td class="temps">${el.time}</td>
                                       <td class="orderSum">
                                          <ul>${ordear()}</ul>
                                       </td>
                                       <td class="total">${el.total} DA</td>
                                       <td class="type">${el.type}</td>
                                       <td class="statu">
                                          <p class="${el.status}" onclick="popup(this.parentElement.parentElement)">${el.status}</p>
                                       </td>
                                    </tr>`);

                                       if (Notification.permission === "granted") {
                                          // If it's okay let's create a notification
                                          if (el.status == 'confirmation') {
                                             var notification = new Notification("Restaurant Abou Anas", {
                                                body: 'Vous avez une nouvelle commande!'

                                             });
                                          }
                                       }

                                       // Otherwise, we need to ask the user for permission
                                       else if (Notification.permission !== "denied") {
                                          Notification.requestPermission().then(function(permission) {
                                             // If the user accepts, let's create a notification
                                             if (permission === "granted") {
                                                if (el.status == 'confirmation') {
                                                   var notification = new Notification("Restaurant Abou Anas", {
                                                      body: 'Vous avez une nouvelle commande!'

                                                   });
                                                }
                                             }
                                          });
                                       }
                                    })
                                 }
                              })
                           }, 1000);
                        })
                     </script>



                  </table>
               </div>
            </div>
         </div>

      </div>

   </div>




   <div class="popup">
      <div class="">
         <h2>Modifier le Statu?</h2>

         <form action="./updateStatus.php" method="POST">
            <input type="hidden" id="orderId" name="orderId">
            <button type="submit" name="annuler" class="annuler">annuler la commande</button>
            <button type="submit" name="avancer">Modifier</button>
         </form>
      </div>
   </div>

</body>

</html>