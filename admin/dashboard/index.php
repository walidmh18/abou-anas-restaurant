<!DOCTYPE html>
<html lang="en">

<head>
   <?php
   include '../../head.php';
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
            <div class="stats">
               <div class="stat">
                  <div class="icon"><i class="fa-regular fa-circle-dollar"></i></div>
                  <h3>10,10010,.112 DZD</h3>
                  <p>total revenue</p>
               </div>
               <div class="stat">
                  <div class="icon"><i class="fa-sharp fa-regular fa-utensils"></i></div>
                  <h3>10,10010,.112 DZD</h3>
                  <p>total revenue</p>
               </div>
               <div class="stat">
                  <div class="icon"><i class="fa-regular fa-list-ul"></i></div>
                  <h3>10,10010,.112 DZD</h3>
                  <p>total revenue</p>
               </div>
            </div>
            <div class="rapport-jour">
               <div class="header">
                  <h2>Rapport de jour</h2>
               </div>
               <div class="tableHeader">
                  <p>Client</p>
                  <p>Temps</p>
                  <p>Articles</p>
                  <p>Total</p>
                  <p>statu</p>
               </div>
               <div class="table">
                  <div class="tableElement">
                     <p class="client">table 1</p>
                     <p class="temps">il y'a 5 min</p>
                     <p class="orderSum">items</p>
                     <p class="total">1000DA</p>
                     <p class="statu livre">Livrer</p>

                  </div>
               </div>
            </div>
         </div>
         <div class="right">
            <div class="mostOrdered">
               <div class="header">
                  <p>Most Ordered</p>
               </div>
               <div class="itemsContainer">
                  <div class="item">
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
                  </div>
                  <div class="item">
                     <img src="../../images/pack.png" alt="">
                     <div class="info">
                        <p class="name">pack</p>
                        <p class="qty">200 dishes</p>

                     </div>
                  </div>
               </div>
               <a href="./mostOrdered.php" class="voirTous">Voir tous</a>
            </div>
            <div class="mostType">
               <div class="header">
                  <p>Most Type of order</p>
               </div>
               <div class="container">

               </div>
            </div>
         </div>
      </div>

   </div>

</body>

</html>