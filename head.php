<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./style.css">
<script src="./app.js" defer></script>

<style>
   :root{
   --d1:  #181818;
   --d2 : #333333;
   --l1: #F7F7F7;
   --l2: #DEDEDE;
   --b1: #5E2103;
   --b2: #EECA93;
   --green: #198754;
   --red: #DC3545;
   --l-green: #D1E7DD;
   --l-red: #F8D7DA;


   --ar-font: 'Alexandria', sans-serif;
   --en-font: 'Nunito Sans', sans-serif;
}



*{
   padding: 0;
   margin: 0;
   box-sizing: border-box;
   font-family: var(--en-font);

}

html{
   scroll-behavior: smooth;
   overflow-x: hidden;

}

body{
   background: var(--d1);
   min-height: 100lvh;
   font-size: 8px;
   overflow-x: hidden;
}

a,button{
   all: unset;
   cursor: pointer;
}

.ar{
   font-family: var(--ar-font);

}

.ar:not(.categoryTitle h2){
   font-size: 80%;
}

.fr,.en{
   font-family: var(--en-font);
   font-style: normal;
   font-variation-settings:
     "wdth" 100,
     "YTLC" 500;
   font-optical-sizing: auto;
}

ul li{
   list-style: none;
}

.y-button{
   background: var(--b2);
   color: var(--b1);
   padding: 1em 2em;
   display: block;
   text-align: center;
   border-radius: 1em;
   font-size: 2em;
   font-weight: 500;
}

</style>