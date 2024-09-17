<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <?php include'../../head.php'; ?>
   <link rel="stylesheet" href="../style.css">
   <title>Document</title>
   <style>
      body{
         width: 100%;
         height: 100%;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         color: var(--l1);
         font-size: 15px;
         text-align: center;
         gap: 2em;
      }
      h1.ar{
         font-size: 140% !important;
      }
   </style>

   <script>
      setTimeout(() => {
         window.location= '../'
      }, 7000);
   </script>
</head>
<body>
   <img src="./success.svg" alt="">
   <h1 class="ar"> تم استلام طلبكم بنجاح</h1>
   <h1 class="fr">Votre commande
   a été reçue</h1>
</body>
</html>