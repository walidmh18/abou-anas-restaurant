var Swipes = new Swiper('.swiper-container', {
   loop: true,
   slidesPerView: 1,
   spaceBetween: 10,
   autoplay: false,
   loop: false,
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
const emporter = document.querySelector('.sidePanel.emporter')
const livraison = document.querySelector('.sidePanel.livraison')


let the_cart = []

let step = 0
updateStep()
function updateStep() {
   if (step == 0) {
      confirmer.classList.remove('active')
      commander.classList.add('active')




      backBtn.classList.remove('active')
      addtocartBtns.forEach(b => {
         b.classList.remove('active')
      })

   } else if (step == 1) {
      modifier.classList.remove('active')

      confirmer.classList.add('active')
      commander.classList.remove('active')



      backBtn.classList.add('active')


      checkCartBtn.classList.remove('active')


      cart.classList.remove('active')




      addtocartBtns.forEach(b => {
         let qua = b.parentElement.querySelector('.quantity')
         if (!qua.classList.contains('active')) {
            b.classList.add('active')
            
         }
         b.addEventListener('click', () => {
            let inp = b.parentElement.querySelector('.quantity input')


            b.classList.remove('active')
            qua.classList.add('active')
            incr(inp)
         })
      })

   } else if (step == 2) {
      modifier.classList.add('active')
      confirmer.classList.remove('active')


      checkCartBtn.classList.add('active')
      checkBtn.classList.remove('active')
      cart.classList.add('active')
      cart.classList.remove('edit')


      info.classList.remove('active');
   } else if (step == 2.5) {
      modifier.classList.remove('active')


      checkCartBtn.classList.remove('active')
      checkBtn.classList.add('active')


      cart.classList.add('edit');

   } else if (step == 3) {
      modifier.classList.remove('active')
      plcommande.classList.remove('active')
      checkCartBtn.classList.remove('active')

      info.classList.add('active')

      table.classList.remove('active')
      emporter.classList.remove('active')
      livraison.classList.remove('active')

   } else if (step == 4) {
      plcommande.classList.add('active')
   }
}


backBtn.addEventListener('click', () => {
   if (step == 1) {
      step = 0
   } else if (step == 2) {
      step = 1
   } else if (step == 2.5) {
      step = 2
   } else if (step == 3) {
      step = 2
   } else if (step == 4) {
      step = 3
   }
   updateStep()
})




commander.addEventListener('click', () => {
   if (step == 0) {
      step = 1
   }

   updateStep()
})


confirmer.addEventListener('click', () => {
   if (step == 1) {
      step = 2
   }
   updateStep()
})

modifier.addEventListener('click', () => {
   if (step == 2) {
      step = 2.5
   }

   updateStep()
})


checkCartBtn.addEventListener('click', () => {
   if (step == 2) {
      step = 3
   }
   updateStep()
})

checkBtn.addEventListener('click', () => {
   if (step == 2.5) {
      step = 2
   }

   updateStep()
})




function redu(e) {
   if (e.value > 0) {
      e.value--

   }
   e.focus()

}


const sideCartContainer = cart.querySelector('.itemsContainer')


function incr(e) {
   e.value++
   e.focus()

   let found = false;
   let type = e.parentElement.parentElement.parentElement.parentElement.getAttribute('data-type')
   let img,contents,id

   if (type == 'pack') {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      console.log(img);
      contents = e.parentElement.parentElement.parentElement.parentElement.querySelector('ul').innerHTML
   }else{
      id = e.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      console.log(img);
      contents = ''
   }
   let name = {
      fr: e.parentElement.parentElement.parentElement.querySelector('.fr').innerHTML,
      ar: e.parentElement.parentElement.parentElement.querySelector('.ar').innerHTML
   }

   let price = e.parentElement.parentElement.parentElement.querySelector('h2.price').innerHTML
   console.log(price);

   console.log(name);
   for (let i = 0; i < the_cart.length; i++) {
      if (the_cart[i].id == id && the_cart[i].type == type) {
         the_cart[i].qty++
         document.querySelector('#cartItem'+the_cart[i].id).querySelector('span.qty').innerHTML++
         found = true
      }



   }

   if (found == false) {
      let obj = { id: id, qty: 1, type: type, img: img, name: name, price: price.replace(" DA","") , contents:contents}
      the_cart.push(obj)
      let sideEl = document.createElement('div')
      sideEl.classList.add(obj.type)
      sideEl.id = 'cartItem'+obj.id
      if (type == 'plat') {
         sideEl.innerHTML = `
         <div class="left">
                    <button class="del" onclick="delCartItem(this.parentElement.parentElement)">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <img src="${obj.img}" alt="">

                    <div class="platName">
                        <p class="fr">${obj.name.fr}</p>
                        <p class="ar">${obj.name.ar}</p>
                    </div>
                </div>

                <div class="right">
                    <p class="uprice">${obj.price}</p>
                    <p>x<span class="qty">${obj.qty}</span></p>
                    <div class="qtyControls">
                        <button onclick="increaseQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-up"></i></button>
                        <button onclick="reduceQty(this.parentElement.parentElement)"><i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                </div>
         `
      }else if (type == 'pack'){
         sideEl.innerHTML = `
         <div class="header">
                    <div class="left">
                        <button class="del" onclick="delCartItem(this.parentElement.parentElement)">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <img src="${obj.img}" alt="">

                        <div class="platName">
                            <p class="fr">${obj.name.fr}</p>
                            <p class="ar">${obj.name.ar}</p>
                        </div>
                    </div>
                    

                    <div class="right">
                        <p class="uprice">${obj.price}</p>
                        <p>x<span class="qty">${obj.qty}</span></p>
                        <div class="qtyControls">
                            <button onclick="increaseQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-up"></i></button>
                            <button onclick="reduceQty(this.parentElement.parentElement)"><i class="fa-solid fa-chevron-down"></i></button>
                        </div>
                    </div>
                </div>
                <div class="contents">
                    ${obj.contents}
                </div>
         `
      }

      sideCartContainer.append(sideEl)

   } 

   console.log(the_cart);

   updateTotal(the_cart)
}

function increaseQty(e) {
   e.innerHTML ++
   updateTotal(the_cart)

}

function updateTotal(o){
   let total=0
   let tp = [
      document.querySelector('#totalPrice'),
      document.querySelector('#totalPrice1'),
      document.querySelector('#totalPrice2'),
      document.querySelector('#totalPrice3')
   ]
   o.forEach(el=>{
      console.log(Number(el.price));
      total += el.qty * Number(el.price)
   })
   console.log(total);
   tp.forEach(t=>{
      t.innerHTML = total+ 'DA'
   })

   
}



function redu(e) {
   let id = e.parentElement.parentElement.parentElement.id
   if (e.value > 0) {
      
      e.value--

      document.querySelector('#cartItem'+id).querySelector('span.qty').innerHTML--


   }


   e.focus()

   if (e.value == 0) {
      e.parentElement.classList.remove('active')
      e.parentElement.parentElement.querySelector('.addtocart').classList.add('active')
      document.querySelector('#cartItem'+id).remove()
   }


   for (let i = 0; i < the_cart.length; i++) {
      if (the_cart[i].id == id) {

         the_cart[i].qty--
         if (the_cart[i].qty == 0) {
            the_cart.splice(i, 1)
         }
      }



   }

   console.log(the_cart);
   updateTotal(the_cart)

}
function corr(e) {
   if (e.value <= 0) {
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
      ar: 'كبدة غنمي',
      fr: 'Foie mouton',
      price: 100
   },
   {
      ar: 'كبدة بقري',
      fr: 'Foie vaux',
      price: 90
   }, {
      ar: 'لحم',
      fr: 'viande',
      price: 80
   }, {
      ar: 'داند',
      fr: 'dinde',
      price: 70
   }, {
      ar: 'القلب',
      fr: 'coeur',
      price: 70
   }, {
      ar: 'نقانق',
      fr: 'Merguez',
      price: 70
   }, {
      ar: 'ليري',
      fr: 'Liri',
      price: 90
   }, {
      ar: 'شيش كباب',
      fr: 'Chiche kebab',
      price: 70
   }, {
      ar: 'شيش طاووق',
      fr: 'Chiche taouk',
      price: 150
   }, {
      ar: 'داند روايال',
      fr: 'Royal dinde',
      price: 150
   }, {
      ar: 'أسياخ ملفوف',
      fr: 'Brochette melfouf',
      price: 150
   }, {
      ar: 'أسياخ مسحب',
      fr: 'Brochette mashable',
      price: 150
   }
]
function createSandwich() {


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



   brochettes.forEach(b => {
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


   sandwichContents.innerHTML += `
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


function addSandwich() {
   if (step <= 1) {
      step = 1
      updateStep();
   }
   createSandwich()
   sandwichesCount++
}

function delSandwich(e) {
   e.remove()
   sandwichesCount--

   if (sandwichesCount == 0 && step == 1) {
      step = 0
      updateStep()
   }
}



function delCartItem(e) {
   console.log(e);
   if (e.classList.contains('plat')) {
      e.remove()
   } else if (e.parentElement.classList.contains('pack')) {
      e.parentElement.remove()
   }
}

function reduceQty(e) {
   if (e.querySelector('span.qty').innerHTML > 1) {
      e.querySelector('span.qty').innerHTML--
   } else if (e.querySelector('span.qty').innerHTML == 1) {
      delCartItem(e.parentElement)
   }

   console.log(e.parentElement.id);
   let objId = e.parentElement.id.replace('cartItem','');

   the_cart.forEach(c=>{
      if (c.id == objId) {
         c.qty --
      }
   })
   updateTotal(the_cart)
}


function fixOrderType(a) {
   if (step == 3) {
      step = 4
      if (a == 'sp') {

         table.classList.add('active')

      } else if (a == 'emp') {
         emporter.classList.add('active')

      } else if (a == 'liv') {
         livraison.classList.add('active')

      }
      updateStep()
   }
}