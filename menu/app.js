var Swipes = new Swiper('.swiper-container', {
   loop: true,
   slidesPerView: 1,
   spaceBetween: 10,
   autoplay: true,
   loop: false,
   pagination: {
      el: '.swiper-pagination',
   },
   breakpoints: {
      425: {
         slidesPerView: 2,
      },

      900: {
         slidesPerView: 3,
      },
      1200: {
         slidesPerView: 4
      },
      1400: {
         slidesPerView: 5
      }
   }
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

addtocartBtns.forEach(b => {
   b.addEventListener('click', () => {
      let inp = b.parentElement.querySelector('.quantity input')
      incr(inp)
   })
})

setInterval(() => {

}, 1000);

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


            b.classList.remove('active')
            qua.classList.add('active')
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


const finalForm = document.querySelector('#CartForm')


checkCartBtn.addEventListener('click', () => {
   if (step == 2) {
      let total = 0
      step = 3
      the_cart.forEach(el => {
         total += el.qty * Number(el.price)
      })
      document.querySelector('input#cartInp').value = JSON.stringify(the_cart)
      document.querySelector('input#totalInp').value = total

   }
   updateStep()
})

checkBtn.addEventListener('click', () => {
   if (step == 2.5) {
      step = 2
   }

   updateStep()
})






const sideCartContainer = cart.querySelector('.itemsContainer')


function incr(e) {
   e.value++
   e.focus()

   let found = false;
   let type = e.parentElement.parentElement.parentElement.parentElement.getAttribute('data-type')
   let img, contents, id

   if (type == 'pack') {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      contents = '';
      e.parentElement.parentElement.parentElement.parentElement.querySelectorAll('ul li').forEach(lii => {
         contents += `${lii.innerHTML},`
      });
      contents = contents.slice(0, -1);
   } else if (type == 'plat') {
      id = e.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      contents = ''
   } else if (type == 'sandwich') {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      img = ''
      contents = the_cart.find(q => q.id == id && q.type == 'sandwich').ings
   }
   let name = {
      fr: e.parentElement.parentElement.parentElement.querySelector('.fr').innerHTML,
      ar: e.parentElement.parentElement.parentElement.querySelector('.ar').innerHTML
   }

   let price = e.parentElement.parentElement.parentElement.querySelector('h2.price').innerHTML

   for (let i = 0; i < the_cart.length; i++) {
      if (the_cart[i].id == id && the_cart[i].type == type) {

         if (document.querySelector('#cart' + type + the_cart[i].id)) {
            the_cart[i].qty++
            document.querySelector('#cart' + type + the_cart[i].id).querySelector('span.qty').innerHTML++
            found = true

         }
      }
   }

   if (found == false) {
      let obj = { id: id, qty: 1, type: type, img: img, name: name, price: price.replace(" DA", ""), contents: contents }
      if (type != 'sandwich') { the_cart.push(obj) }
      let sideEl = document.createElement('div')
      sideEl.classList.add(obj.type)
      sideEl.id = 'cart' + obj.type + obj.id

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
      <button onclick="reduceQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-down"></i></button>
   </div>
</div>
         `
      } else if (type == 'pack') {
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
         <button onclick="reduceQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-down"></i></button>
      </div>
   </div>
</div>
<div class="contents">
   ${obj.contents}
</div>
         `
      } else if (type == 'sandwich') {



         let contentsContainer = document.createElement('div')
         contentsContainer.classList.add('contents')
         obj.contents.forEach(a => {
            let content = document.createElement('div')
            content.innerHTML = a.qty + '* ' + a.name
            contentsContainer.append(content)
         })
         sideEl.innerHTML = `
<div class="header">
   <div class="left">
      <button class="del" onclick="delCartItem(this.parentElement.parentElement)">
         <i class="fa-solid fa-trash"></i>
      </button>


      <div class="platName">
         <p class="fr">Sandwich</p>
         <p class="ar">سندويش</p>
      </div>
   </div>


   <div class="right">
      <p class="uprice">${obj.price}</p>
      <p>x<span class="qty">${obj.qty}</span></p>
      <div class="qtyControls">
         <button onclick="increaseQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-up"></i></button>
         <button onclick="reduceQty(this.parentElement.parentElement.querySelector('span.qty'))"><i class="fa-solid fa-chevron-down"></i></button>
      </div>
   </div>
</div>

         `
         sideEl.append(contentsContainer)
      }
      sideCartContainer.append(sideEl)

   }


   updateTotal(the_cart)
}



function updateTotal(o) {
   let total = 0
   let tp = [
      document.querySelector('#totalPrice'),
      document.querySelector('#totalPrice1'),
      document.querySelector('#totalPrice2'),
      document.querySelector('#totalPrice3'),
      document.querySelector('#totalPrice4')
   ]
   o.forEach(el => {
      total += el.qty * Number(el.price)
      if (el.qty == 0) {
         o.splice(o.indexOf(el),1);
      }
   })
   tp.forEach(t => {
      t.innerHTML = total + 'DA'
   })


}



function redu(e) {
   let type, id
   if (e.parentElement.parentElement.parentElement.id) {
      id = e.parentElement.parentElement.parentElement.id
      type = e.parentElement.parentElement.parentElement.parentElement.getAttribute('data-type')

   } else {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      type = e.parentElement.parentElement.parentElement.parentElement.getAttribute('data-type')

   }
   if (e.value > 0) {

      e.value--

      document.querySelector('#cart' + type + id).querySelector('span.qty').innerHTML--

   }


   e.focus()

   if (e.value == 0) {
      if (type == 'sandwich') {
         delSandwich(e.parentElement.parentElement.parentElement.parentElement)
      } else {
         e.parentElement.parentElement.querySelector('.addtocart').classList.add('active')
         e.parentElement.classList.remove('active')

      }
      document.querySelector('#cart' + type + id).remove()

   }


   for (let i = 0; i < the_cart.length; i++) {
      if (the_cart[i].id == id) {

         the_cart[i].qty--
         if (the_cart[i].qty == 0) {
            the_cart.splice(i, 1)
         }
      }



   }

   updateTotal(the_cart)

}
function corr(e) {
   let type = e.parentElement.parentElement.parentElement.parentElement.getAttribute('data-type')
   let img, contents, id

   if (type == 'pack') {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      contents = '';
      e.parentElement.parentElement.parentElement.parentElement.querySelectorAll('ul li').forEach(lii => {
         contents += `${lii.innerHTML},`
      });
      contents = contents.slice(0, -1);
   } else if (type == 'plat') {
      id = e.parentElement.parentElement.parentElement.id
      img = e.parentElement.parentElement.parentElement.querySelector('img').getAttribute('src')
      contents = ''
   } else if (type == 'sandwich') {
      id = e.parentElement.parentElement.parentElement.parentElement.id
      img = ''
      contents = the_cart.find(q => q.id == id && q.type == 'sandwich').ings
   }


   
   for (let i = 0; i < the_cart.length; i++) {
      if (the_cart[i].id == id && the_cart[i].type == type) {

         if (document.querySelector('#cart' + type + the_cart[i].id)) {
            the_cart[i].qty = e.value
            document.querySelector('#cart' + type + the_cart[i].id).querySelector('span.qty').innerHTML = e.value
            

         }
      }
   }
   if (e.value <= 0) {
      e.value = 0
   }

   if (e.value == 0) {


      if (type == 'sandwich') {
         delSandwich(e.parentElement.parentElement.parentElement.parentElement)
      } else {
         e.parentElement.parentElement.querySelector('.addtocart').classList.add('active')
         e.parentElement.classList.remove('active')

      }
      document.querySelector('#cart' + type + id).remove()

   }

updateTotal(the_cart)
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

function updateSandwiches() {
   let sandwiches = sandwichesContainer.querySelectorAll('.sandwich')
   for (let i = 0; i < sandwiches.length; i++) {
      let sandwich = sandwiches[i]
      sandwich.id = i
      sandwich.classList.add('sandwich' + i)

   }
}
function createSandwich() {
   let sandwich = document.createElement('div');
   sandwich.classList.add('sandwich');
   sandwich.setAttribute('data-type', 'sandwich')


   let sandwichTop = `
<div class="top">
   <div class="platName">
      <h2 class="fr">
         Sandwich <span></span>
      </h2>
      <h2 class="ar">
         سندويش <span></span>
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





   brochettes.forEach(b => {
      let ing = document.createElement('div')
      ing.classList.add('ingredient')
      ing.setAttribute('data-brochette', b.fr)

      ing.innerHTML +=
         `
<div class="name">
   <p class="fr">${b.fr}</p>
   <p class="ar">${b.ar}</p>
</div>
<div class="price">
   <p class="unitPrice">${b.price}DA *</p>
   <div class="quantity">

      <button onclick="reduIng(this.nextElementSibling);updateSubtotal(this.parentElement.previousElementSibling,this.parentElement.nextElementSibling,this.nextElementSibling,this.parentElement.parentElement.parentElement.parentElement);">
         <i class="fa-regular fa-minus"></i>

      </button>
      <input type="number" value="0" min="0" onblur="corr(this);updateSubtotal(this.parentElement.previousElementSibling,this.parentElement.nextElementSibling,this,this.parentElement.parentElement.parentElement.parentElement);">

      <button onclick="incrIng(this.previousElementSibling);updateSubtotal(this.parentElement.previousElementSibling,this.parentElement.nextElementSibling,this.previousElementSibling,this.parentElement.parentElement.parentElement.parentElement);">
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
         <input type="checkbox" onchange="toggleGarni(this.parentElement.parentElement)">
         <span class="slider"></span>
   </label>
</div>


<div class="sandwichPrice">
   <div class="quantity">

      <button onclick="redu(this.nextElementSibling)">
         <i class="fa-regular fa-minus"></i>

      </button>
      <input type="number" value="0" min="0" onblur="corr(this)">

      <button onclick="incr(this.previousElementSibling)">
         <i class="fa-regular fa-plus"></i>
      </button>
   </div>
   <h2 class="price">0DA</h2>
</div>
`

   sandwich.append(sandwichContents);


   sandwichesContainer.append(sandwich)
   updateSandwiches()

   let obj = {
      id: sandwich.id,
      type: 'sandwich',
      price: 0,
      ings: [],
      add: [],
      qty: 1

   }

   the_cart.push(obj)


}

function incrIng(e) {
   e.value++
   e.focus



}

function reduIng(e) {
   if (e.value >= 1) {
      e.value--

   }
   e.focus
}
function updateSubtotal(up, tp, qt, p) {
   let name = up.parentElement.parentElement.querySelector('.fr').innerHTML
   let unitPrice = up.innerHTML.replace('DA *', '')
   let quantity = qt.value

   let subTotal = unitPrice * quantity

   tp.innerHTML = subTotal + 'DA'


   let totalPriceContainer = p.querySelector('.sandwichPrice h2')
   let subTotals = [...p.querySelectorAll('p.totalPrice')]
   let totalPrice = 0
   for (let i = 0; i < subTotals.length; i++) {
      let pr = Number(subTotals[i].innerHTML.replace('DA', ''))
      totalPrice += pr

   }
   totalPriceContainer.innerHTML = totalPrice + 'DA'

   the_cart.forEach(o => {
      if (o.id == p.parentElement.id && o.type == 'sandwich') {
         o.price = totalPrice
         if (o.ings.find(e => e.name == name)) {
            o.ings.find(e => e.name == name).qty = quantity
         } else {
            o.ings.push({ name: name, qty: quantity })

         }


      }
   })

   refreshSandwichesInCart()
   updateTotal(the_cart)

}


function refreshSandwichesInCart() {
   the_cart.forEach(el => {
      if (el.type == 'sandwich') {
         let element = document.querySelector('#cartsandwich' + el.id)
         element.querySelector('p.uprice').innerHTML = el.price + 'DA'
         element.querySelector('span.qty').innerHTML = el.qty
         let contents = element.querySelector('.contents')
         contents.innerHTML = ''
         el.ings.forEach(ing => {
            let ingredient = document.createElement('div')
            ingredient.classList.add('content')
            ingredient.innerHTML = ing.qty + '* ' + ing.name
            contents.append(ingredient)
         })

         el.add.forEach(ing => {
            let ingredient = document.createElement('div')
            ingredient.classList.add('content')
            ingredient.innerHTML = '+' + ing
            contents.append(ingredient)
         })

      }
   })
}



function toggleGarni(e) {
   let name = e.querySelector('.fr').innerHTML
   let id = e.parentElement.parentElement.id

   if (the_cart.find(l => l.id == id && l.type == 'sandwich')) {
      if (e.querySelector('input').checked) {
         the_cart.find(l => l.id == id && l.type == 'sandwich').add.push(name)
      } else {
         let nid = the_cart.find(l => l.id == id && l.type == 'sandwich').add.indexOf(name)
         the_cart.find(l => l.id == id && l.type == 'sandwich').add.splice(nid, 1);

      }
   }
   refreshSandwichesInCart()


}

let sandwichesCount = 0


function addSandwich() {
   if (step <= 1) {
      step = 1
      updateStep();
   }
   createSandwich()
   sandwichesCount++
   incr(document.querySelector('.sandwiches .itemsContainer').lastChild.querySelector('.sandwichPrice input'))
}

function delSandwich(e) {

   let type, id
   id = e.id
   type = e.getAttribute('data-type')

   e.remove()
   sandwichesCount--
   the_cart.splice(the_cart.indexOf(the_cart.find(o => o.id == e.id && o.type == 'sandwich')), 1)

   if (sandwichesCount == 0 && step == 1 && the_cart == []) {
      step = 0
      updateStep()

   }
   updateSandwiches()

   document.querySelector('#cart' + type + id).remove()
}

function delCartItem(e) {
   let type, id
   if (e.classList.contains('plat')) {
      id = e.id
      e.remove()
      type = 'plat'
   } else if (e.parentElement.classList.contains('pack')) {
      id = e.parentElement.id
      type = 'pack'



      e.parentElement.remove()
   } else if (e.parentElement.classList.contains('sandwich')) {
      id = e.parentElement.id
      e.parentElement.remove()
      type = 'sandwich'

   }

   id = id.replace('cart', '').replace(type, '')
   the_cart.splice(the_cart.indexOf(the_cart.find(u => u.id == id && u.type == type)), 1)

   updateTotal(the_cart)
}

function reduceQty(e) {

   let type = e.parentElement.parentElement.parentElement.className
   if (e.parentElement.parentElement.parentElement.className != 'plat' &&
      e.parentElement.parentElement.parentElement.className != 'pack' &&
      e.parentElement.parentElement.parentElement.className != 'sandwich') {
      type = e.parentElement.parentElement.parentElement.parentElement.className
   }
   let elid = e.parentElement.parentElement.parentElement.id || e.parentElement.parentElement.parentElement.parentElement.id
   let id = elid.replace('cart', '').replace(type, '')

   let inp


   if (type != 'sandwich') {

      inp = document.querySelector(`.${type}${id} .quantity input[type="number"]`)

   } else {
      inp = document.querySelector(`.${type}${id} .sandwichPrice .quantity input[type="number"]`)

   }

   redu(inp)

   if (e.innerHTML == 0) {
      delCartItem(e.parentElement.parentElement.parentElement)
   }


   updateTotal(the_cart)
}

function increaseQty(e) {
   updateTotal(the_cart)

   let type = e.parentElement.parentElement.parentElement.className

   if (e.parentElement.parentElement.parentElement.className != 'plat' && e.parentElement.parentElement.parentElement.className != 'pack' && e.parentElement.parentElement.parentElement.className != 'sandwich') {
      type = e.parentElement.parentElement.parentElement.parentElement.className
   }
   let elid = e.parentElement.parentElement.parentElement.id || e.parentElement.parentElement.parentElement.parentElement.id
   let id = elid.replace('cart', '').replace(type, '')


   let inp

   if (type != 'sandwich') {
      inp = document.querySelector(`.${type}${id} .quantity input[type="number"]`)

   } else {
      inp = document.querySelector(`.${type}${id} .sandwichPrice .quantity input[type="number"]`)

   }

   incr(inp)

}

let orderType


function fixOrderType(a) {
   if (step == 3) {
      step = 4


      if (a == 'sp') {

         table.classList.add('active')
         orderType = 'sur place'
         document.querySelector('#typeInp').value = 'sur place'

      } else if (a == 'emp') {
         emporter.classList.add('active')
         orderType = 'emporter'
         document.querySelector('#typeInp').value = 'emporter'

      } else if (a == 'liv') {
         livraison.classList.add('active')
         orderType = 'livraison'
         document.querySelector('#typeInp').value = 'livraison'

      }
      updateStep()
   }
}

let client

plcommande.addEventListener('click', () => {
   if (orderType == 'sur place') {
      client = document.querySelector('.sidePanel.table input[type="number"]').value
      document.querySelector('#clientInp').value = client
   } else if (orderType == 'emporter') {
      client = `nom: ${document.querySelector('#empNom').value} <br>
tél: ${document.querySelector('#empNum').value}`
      document.querySelector('#clientInp').value = client
   } else if (orderType == 'livraison') {
      client = `nom: ${document.querySelector('#livName').value}<br>
tél: ${document.querySelector('#livNum').value} <br>
loc: ${document.querySelector('#livLocation').value}`
      document.querySelector('#clientInp').value = client
   }

   finalForm.submit()
})


