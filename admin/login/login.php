<?php

include '../../connection.php';
session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
   $login = $_POST['login'];
   $password = $_POST['password'];
   $sql = "SELECT * FROM `workers` WHERE login = '$login'";
   $r = mysqli_query($con,$sql);
   echo '<pre>';
   print_r($r);
   echo '</pre>';

   // echo $r->num_rows;

   if ($r->num_rows == 1) {
      if (mysqli_fetch_assoc($r)['password'] == $password) {
         $_SESSION['login'] = $login;
         $_SESSION['password'] = $password;
         $_SESSION['id'] = mysqli_fetch_assoc($r)['id'];
         header("Location: ../dashboard");
         exit();
      } else{
         header("Location: ./?err=1");
         exit();
      }
   } else {
      header("Location: ./?err=2");
         exit();
   }
}

?>