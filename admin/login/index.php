<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <?php
   include '../../connection.php';
   include '../../head.php';

   session_start();
   if (isset($_SESSION['login'])) {
      header("Location: ../dashboard");
   }
   ?>

   <style>
      * {
         color: var(--l1);
      }

      body {
         display: grid;
         place-items: center;
         font-size: 16px;

      }

      form {
         display: flex;
         flex-direction: column;
         width: 50%;
         background: var(--d2);
         padding: 2em;
         border-radius: 2em;
         box-shadow: #00000033 0 10px 10px 0 ;
      }

      input {
         margin-bottom: 2em;
         padding: 1em;
         background-color: var(--d1);
         border: none;
         border-radius: 0.5em;
      }

      label {
         margin-bottom: 0.5em;
      }

      h1 {
         margin-bottom: 1em;
      }

      button {
         display: block;
         text-align: center;
         background: var(--b2);
         color: var(--b1);
         padding: 0.7em;

         border-radius: 1em;
      }

      p.error {
         color: var(--lred);
         background-color: var(--red);
         border: red solid 1px;
         padding: 1em;
         margin-bottom: 1em;
      }

      @media screen and (max-width:768px) {
         form{
            width: 75%;
         }
      }

      @media screen and (max-width:400px) {
         form{
            width: 95%;
         }
      }
   </style>

</head>

<body>

   <form action="./login.php" method="POST">
      <h1>Login</h1>

      <?php
      if (isset($_GET['err'])) {
         if ($_GET['err'] == '1') {
      ?>
            <p class="error">
               Mot de passe Incorrect.
            </p>
         <?php

         } else if ($_GET['err'] == '2') {
         ?>
            <p class="error">
               Utilisateur non trouvé.
            </p>
         <?php
         } else if ($_GET['err'] == '3') {
         ?>
            <p class="error">
               Vous devez d'abord vous connecter.
            </p>
         <?php
         } else {
         ?>
            <p class="error">
               Erreur inconnu.
            </p>
      <?php
         }
      }

      ?>

      <label for="login">Nom d'utilisateur</label>
      <input type="text" name="login" id="login" required>

      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>
   </form>

</body>

</html>