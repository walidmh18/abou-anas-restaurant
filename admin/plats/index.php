<?php session_start();
if (!isset($_SESSION['login'])) {
header("Location: ../login?err=3");
   exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plats</title>
   <?php include '../../connection.php' ?>
   <?php include '../../head.php' ?>

   <link rel="stylesheet" href="../dashboard/style.css">
   <link rel="stylesheet" href="./style.css">


   <style>
      .sideMenu .pla{
         background:var(--d1);
      }
   </style>
</head>

<body>

   <?php include '../sideMenu.php' ?>
   <div class="body">

      <div class="title">
         <h1>Plats</h1>


      </div>


      <div class="platsContainer">
         <div class="top">
            <a href="./categories.php" class="manageCategories"><i class="fa-regular fa-sliders-simple"></i> Gérer les catégories</a>
            <div class="categoriesMenu">

               <div class="category active" onclick="showPlats(this)">Tous</div>


               <?php


               $sql = "SELECT * FROM `categories`";
               $res = mysqli_query($con, $sql);
               while ($row = mysqli_fetch_assoc($res)) {
               ?>
                  <div class="category" onclick="showPlats(this)" id="category<?= $row['id'] ?>"><?= $row['name_fr'] ?></div>
               <?php
               }


               ?>


            </div>
         </div>

         <div class="categoriesShow Tous">
            <div class="addPlat" onclick="popup('')">
               <i class="fa-regular fa-plus"></i>
            </div>

            <?php
            $sql = "SELECT * FROM `plats`";
            $res = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
            ?>

               <div class="plat" id="<?= $row['id'] ?>">
                  <img src="<?= $row['image_address'] ?>" alt="<?= $row['name_fr'] ?>">
                  <p class="fr"><?= $row['name_fr'] ?></p>
                  <p class="ar"><?= $row['name_ar'] ?></p>
                  <p class="price"><?= $row['price'] ?></p>
                  <button onclick="popup(this.parentElement.id)" class="y-button">Modifier</button>
               </div>

            <?php
            }
            ?>
            
         </div>

         <?php

         $sql = "SELECT * FROM `categories`";
         $result = mysqli_query($con, $sql);
         while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];

         ?>

            <div class="categoriesShow <?= $row['name_fr'] ?>">

               <?php
               $sql2 = "SELECT * FROM `plats` WHERE category = '$id'";
               $result2 = mysqli_query($con, $sql2);

               while ($row2 = mysqli_fetch_assoc($result2)) {
               ?>

                  <div class="plat" id="<?= $row2['id'] ?>">
                     <img src="<?= $row2['image_address'] ?>" alt="<?= $row2['name_fr'] ?>">
                     <p class="fr"><?= $row2['name_fr'] ?></p>
                     <p class="ar"><?= $row2['name_ar'] ?></p>
                     <p class="price"><?= $row2['price'] ?></p>
                     <button onclick="popup(this.parentElement.id)" class="y-button">Modifier</button>
                  </div>
               <?php
               }
               ?>
               <div class="addPlat" onclick="popup('')">
                  <i class="fa-regular fa-plus"></i>
               </div>

            </div>


         <?php


         }


         ?>
         <div class="categoriesShow plats">
            <div class="addPlat">
               <i class="fa-regular fa-plus"></i>
            </div>
            <div class="plat">
               <img src="../../images/plat1.png" alt="">
               <p class="fr">name</p>
               <p class="ar">الاسم</p>
               <p class="price">1200DA</p>
               <button onclick="popup(this)" class="y-button">Modifier</button>
            </div>
         </div>

      </div>
   </div>
   <div class="popup">
      <div class="container">
         <form action="./addPlat.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idInp">

            <label for="image" id="imageUpload">
               <img src="https://img.freepik.com/free-photo/dark-abstract-background_1048-1920.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1726876800&semt=ais_hybrid" alt="">
               <input type="file" name="image" id="image" hidden accept="image/*">
               <div class="overlay"></div>

            </label>

            <div class="inp">
               <label for="nomFr">Nom (FR)</label>
               <input type="text" name="nomFr" id="nomFr">
            </div>
            <div class="inp">
               <label for="nomAr">Nom (AR)</label>
               <input type="text" name="nomAr" id="nomAr">
            </div>

            <div class="inp">
               <label for="prix">Prix</label>
               <input type="text" name="prix" id="prix">
            </div>

            <div class="inp">
               <label for="CategoryInp">categorie</label>
               <select name="categoryInp" id="categoryInp">
                  <option value="1" selected hidden>choisir une categorie</option>
                  <?php

                  $sql = "SELECT * FROM `categories`";
                  $res = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                     <option value="<?= $row['id'] ?>"><?= $row['name_fr'] ?></option>



                  <?php
                  }

                  ?>

               </select>
            </div>
            <div class="buttons">
               <button class="cancel" type="button" onclick="closePopup()">Annuler</button>
               <button class="delete" type="submit" name="delete">Suprimer</button>
               <button class="save" type="submit" name="save">Enregistrer</button>
            </div>

         </form>
      </div>
   </div>

</body>

</html>