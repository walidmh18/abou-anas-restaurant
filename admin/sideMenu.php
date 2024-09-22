<style>
   
   :root{
      --ui1: #7385C5;
      --ui2:#D88FDA;
      --ui3:#897ADD;
      --sideMenuWidth: 20vw;
   }
.sideMenu{
   color: var(--l1);
   width: var(--sideMenuWidth);
   display: flex;
   flex-direction: column;
   padding: 2em;
   height: 100dvh;
   gap: 2em;
   background: var(--d2);
   position: fixed;
   top: 0;left: 0;
}

.sideMenu .links{
   display: flex;flex-direction: column;
   gap: 5px;
   flex: 1;
}

.body{
   margin-left: var(--sideMenuWidth);
   width: calc(100vw - var(--sideMenuWidth));
}
.sideMenu a h2{
   font-weight: 900;
}

.sideMenu a{
   padding:1em 2em;
   display: flex;
   align-items: center;
   gap: 10px;
   transition: 0.3s;
   border-radius: 1em;
   font-size: 1em;
}

.sideMenu .links a:hover{
   background: var(--d1);
}

.sideMenu a.active{
   color: var(--b2);
}


@media screen and (max-width:1000px) {
   :root{
      --sideMenuWidth: 25vw;

   }
   
}

@media screen and (max-width:768px) {

   :root{
      --sideMenuWidth: 4em;

   }
   .body{
      margin-left: 4em;
   }
   .sideMenu a:has(h2){
      display: none;
   }
   .sideMenu a{
      font-size: 1.6em;
      padding: .5em .7em;
   }
   body{
      font-size: 12px;
   }
   .sideMenu{
      padding: 8em 0 3em;
   }
   .sideMenu a p{
      overflow: hidden;
      width: 0;
      text-wrap: nowrap;
   }
}
</style>


<div class="sideMenu">
   <a href="../">
      <h2>Restaurant Abou Anas</h2>
   </a>

   <div class="links">
      <a href="../" class="tdb"><i class="fa-regular fa-house"></i>
         <p>Tableau de bord</p>
      </a>
      <a href="../report" class="rap"><i class="fa-regular fa-memo-pad"></i>
         <p>Rapport</p>
      </a>
      <a href="../plats" class="pla"><i class="fa-regular fa-utensils"></i>
         <p>Plats</p>
      </a>
      <!-- <a href="../workers" class="sta"><i class="fa-regular fa-users"></i>
         <p>Staff</p>
      </a> -->
      <a href="../../" target="_blank"><i class="fa-regular fa-list-ul"></i>
         <p>Voir le Menu <i class="fa-solid fa-arrow-up-right-from-square"></i></p>
      </a>
   </div>
   <a href="../disconnect.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>
      <p>Déconnecter</p>
   </a>
</div>