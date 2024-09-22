<!DOCTYPE html>
<html lang="en">

<>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categories</title>
   <?php include '../../connection.php' ?>
   <?php include '../../head.php' ?>

   <link rel="stylesheet" href="../dashboard/style.css">
   <link rel="stylesheet" href="./style.css">

   <style>
      .tableContainer {
         background: var(--d2);
         padding: 2em;
         border-radius: 2em;
      }

      .table {
         width: 100%;
      }

      .addCategory {
         border: 2px solid var(--b2);
         border-radius: 0.5em;
         color: var(--b2);
         padding: 1em 2em;
      }

      .editCategory {
         background: var(--b2);
         color: var(--d2);
         padding: 0.5em 1em;
         border-radius: 0.5em;
      }

      td:has(button) {
         text-align: right;
         /* background: red; */
      }

      td {
         vertical-align: middle;
      }
   </style>
</>

<body>

   <?php include '../sideMenu.php' ?>
   <div class="body">

      <div class="title">
         <h1>Categories</h1>
         <div class="tableContainer">

            <button onclick="popupp('')" class="addCategory">Ajouter une Categorie </button>

            <table class="table">
               <tr class="tableHeader">
                  <th>Nom FR</th>
                  <th>Nom AR</th>
                  <th>Nombre de plats</th>
                  <td></td>
               </tr>

               <?php
               $sql = "SELECT * FROM categories";
               $query = mysqli_query($con, $sql);
               while ($row = mysqli_fetch_assoc($query)) {
                  $id = $row['id'];

                  $sql2 = "SELECT * FROM `plats` WHERE category = '$id'";
                  $response = mysqli_query($con,$sql2);
                  $num_plats = mysqli_num_rows($response);
               ?>

                  <tr class="tableElement" id="<?= $row['id'] ?>">
                     <td class="fr"><?= $row['name_fr'] ?></td>
                     <td class="ar"><?= $row['name_ar'] ?></td>
                     <td><?= $num_plats ?></td>
                     <td><button onclick="popupp(this.parentElement.parentElement.id)" class="editCategory">Modifier</button></td>
                  </tr>
               <?php
               }

               ?>


            </table>
         </div>
      </div>





   </div>

   <div class="popup">
      <div class="container">
         <form action="./addCategory.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="idInp" id="idInp">

            <div class="inp">
               <label for="nomFr">Nom (FR)</label>
               <input type="text" name="nomFr" id="nomFr">
            </div>
            <div class="inp">
               <label for="nomAr">Nom (AR)</label>
               <input type="text" name="nomAr" id="nomAr">
            </div>



            <
               <div class="buttons">
               <button class="cancel" type="button" onclick="closePopup()">Annuler</button>
               <button class="delete" type="submit" name="delete">Suprimer</button>
               <button class="save" type="submit" name="save">Enregistrer</button>
      </div>

      </form>
   </div>
   </div>

   <script>
      const popupElement = document.querySelector('.popup')

      function popupp(e){
console.log(e);
popupEl.style.display = 'grid'
popupEl.querySelector('#idInp').value = e
popupEl.querySelector('#nomFr').value = document.getElementById(e).querySelector(`.fr`).innerHTML
popupEl.querySelector('#nomAr').value = document.getElementById(e).querySelector(`.ar`).innerHTML
console.log(document.getElementById(e).querySelector(`.ar`).innerHTML);


}
   </script>

</body>

</html>