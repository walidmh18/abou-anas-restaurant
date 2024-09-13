var Swipes = new Swiper('.swiper-container', {
   loop: true,
   slidesPerView: 1,
   spaceBetween: 10,
   autoplay: true,
   loop:false,
   pagination: {
      el: '.swiper-pagination',
   },
});



const addtocartBtns = document.querySelectorAll('button.addtocart')
const backBtn = document.querySelector('.actionBtns .backBtn')
const commander = document.querySelector('button.commander')
const confirmer = document.querySelector('button.confirmer')
const modifier = document.querySelector('button.modifier')
const plcommande = document.querySelector('button.plcommande')
const checkBtn = document.querySelector('button.checkBtn')
const checkCartBtn = document.querySelector('button.checkCartBtn')

const cart = document.querySelector('.sidePanel.cart')
const info = document.querySelector('.sidePanel.info')
const table = document.querySelector('.sidePanel.table')



let step = 0
updateStep()
function updateStep(){
   if (step == 0) {
      confirmer.classList.remove('active')
      commander.classList.add('active')




      backBtn.classList.remove('active')

   } else if(step == 1) {
      modifier.classList.remove('active')

      confirmer.classList.add('active')
      commander.classList.remove('active')



      backBtn.classList.add('active')


      checkCartBtn.classList.remove('active')


      cart.classList.remove('active')




      addtocartBtns.forEach(b=>{
         b.classList.add('active')
         b.addEventListener('click',() => {
            let qua = b.parentElement.querySelector('.quantity')
            let inp = b.parentElement.querySelector('.quantity input')
            console.log(qua,inp);
            inp.value = 1

            b.classList.remove('active')
            qua.classList.add('active')
         })
      })
      
   }else if(step == 2){
      modifier.classList.add('active')
      confirmer.classList.remove('active')


      checkCartBtn.classList.add('active')
      checkBtn.classList.remove('active')
      cart.classList.add('active')
      cart.classList.remove('edit')


      info.classList.remove('active');
   }else if(step == 2.5){
      modifier.classList.remove('active')


      checkCartBtn.classList.remove('active')
      checkBtn.classList.add('active')


      cart.classList.add('edit');

   } else if(step == 3){
      modifier.classList.remove('active')
      plcommande.classList.remove('active')
      checkCartBtn.classList.remove('active')

      info.classList.add('active')

      table.classList.remove('active')

   }else if(step == 4){
      plcommande.classList.add('active')
   }
}


backBtn.addEventListener('click',() => {
   if (step == 1) {
      step = 0
   } else if (step == 2) {
      step =1
   } else if(step ==2.5){
      step =2
   } else if (step==3) {
      step=2
   } else if (step == 4){
      step = 3
   }
   updateStep()
})




commander.addEventListener('click', () => {
   if(step == 0){
      step = 1
   }

   updateStep()
})


confirmer.addEventListener('click',() => {
   if (step == 1) {
      step =2
   }
   updateStep()
})

modifier.addEventListener('click' ,() => {
   if(step == 2){
      step = 2.5
   }

   updateStep()
})


checkCartBtn.addEventListener('click',() => {
   if (step == 2) {
      step = 3
   }
   updateStep()
})

checkBtn.addEventListener('click',() => {
   if (step == 2.5) {
      step =2
   }

   updateStep()
})




function redu(e){
   if (e.value>0) {
      e.value --

   }
   e.focus()

}


function incr(e){
   e.value ++
   e.focus()
}

function redu(e){
   if (e.value>0) {
      e.value --

   }

   
   e.focus()

   if (e.value == 0) {
      e.parentElement.classList.remove('active')
      e.parentElement.parentElement.querySelector('.addtocart').classList.add('active')
   }
}
function corr(e){
   if (e.value<= 0) {
      e.value = 0
   }

   if (e.value == 0) {
      e.parentElement.classList.remove('active')
      e.parentElement.parentElement.querySelector('.addtocart').classList.add('active')
   }

}





const sandwichesContainer = document.querySelector('.sandwiches .itemsContainer');

const brochettes = [
   {
      ar:'كبدة غنمي',
      fr:'Foie mouton',
      price:100
   },
   {
      ar:'كبدة بقري',
      fr:'Foie vaux',
      price:90
   },{
      ar:'لحم',
      fr:'viande',
      price:80
   },{
      ar:'داند',
      fr:'dinde',
      price:70
   },{
      ar:'القلب',
      fr:'coeur',
      price:70
   },{
      ar:'نقانق',
      fr:'Merguez',
      price:70
   },{
      ar:'ليري',
      fr:'Liri',
      price:90
   },{
      ar:'شيش كباب',
      fr:'Chiche kebab',
      price:70
   },{
      ar:'شيش طاووق',
      fr:'Chiche taouk',
      price:150
   },{
      ar:'داند روايال',
      fr:'Royal dinde',
      price:150
   },{
      ar:'أسياخ ملفوف',
      fr:'Brochette melfouf',
      price:150
   },{
      ar:'أسياخ مسحب',
      fr:'Brochette mashable',
      price:150
   }
]
function createSandwich(){
   

let sandwich = document.createElement('div');
sandwich.classList.add('sandwich');

let sandwichTop = `
<div class="top">
   <div class="platName">
      <h2 class="fr">
         Sandwich <span>1</span>
      </h2>
      <h2 class="ar">
         سندويش <span>1</span>
      </h2>
   </div>
   <i class="fa-solid fa-minus" onclick="delSandwich(this.parentElement.parentElement)"></i>
</div>
`
sandwich.innerHTML += sandwichTop

let sandwichContents = document.createElement('div');
sandwichContents.classList.add('contents')

sandwichContents.innerHTML += 
`<div class="header">
   <p class="fr">Brochettes</p>
   <p class="ar">أسياخ</p>

</div>`


console.log(sandwichContents);



brochettes.forEach(b=>{
   let ing = document.createElement('div')
   ing.classList.add('ingredient')

   ing.innerHTML +=
   `
<div class="name">
   <p class="fr">${b.fr}</p>
   <p class="ar">${b.ar}</p>
</div>
<div class="price">
   <p class="unitPrice">${b.price}DA *</p>
   <div class="quantity">

      <button onclick="redu(this.nextElementSibling)">
         <i class="fa-regular fa-minus"></i>

      </button>
      <input type="number" value="0" min="0" onblur="corr(this)">

      <button onclick="incr(this.previousElementSibling)">
         <i class="fa-regular fa-plus"></i>
      </button>
   </div>
   <p class="totalPrice">0DA</p>
</div>

   `

   sandwichContents.append(ing)

})


sandwichContents.innerHTML+=`
<div class="header">
   <p class="fr">Garnitures</p>
   <p class="ar">اضافات</p>

</div>

<div class="ingredient">
   <div class="name">
         <div class="fr">Frittes</div>
         <div class="ar">بطاطا</div>
   </div>
   <label class="switch">
         <input type="checkbox">
         <span class="slider"></span>
   </label>
</div>
`

sandwich.append(sandwichContents);


sandwichesContainer.append(sandwich)

}


let sandwichesCount = 0


function addSandwich(){
   if (step <= 1) {
      step = 1
      updateStep();
   }
   createSandwich()
   sandwichesCount++
}

function delSandwich(e){
   e.remove()
   sandwichesCount--

   if (sandwichesCount == 0 && step == 1) {
      step = 0
      updateStep()
   }
}



function delCartItem(e){
   console.log(e);
   e.remove();
}

function reduceQty(e){
   if(e.querySelector('span.qty').innerHTML>1){
      e.querySelector('span.qty').innerHTML--
   } if (e.querySelector('span.qty').innerHTML == 1){
      delCartItem(e.parentElement)
   }
}




function fixOrderType(a){
   if (step == 3) {
      if (a == 'sp') {
         console.log(a);
         step = 4

         table.classList.add('active')

      }else if(a == 'emp'){
         console.log(a);

      }else if(a == 'liv'){
         console.log(a);

      }
      updateStep()
   }
}