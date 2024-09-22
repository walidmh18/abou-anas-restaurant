

const popupEl = document.querySelector('.popup');



function popup(e){

   popupEl.style.display = 'grid'
   popupEl.querySelector('#idInp').value = e
   popupEl.querySelector('img').src = document.getElementById(e).querySelector('img').src
   popupEl.querySelector('#nomFr').value = document.getElementById(e).querySelector(`.fr`).innerHTML
   popupEl.querySelector('#nomAr').value = document.getElementById(e).querySelector(`.ar`).innerHTML
   popupEl.querySelector('#prix').value = document.getElementById(e).querySelector(`.price`).innerHTML



}

function closePopup(){
   popupEl.style.display = 'none'
   popupEl.querySelector('#idInp').value = ''
   popupEl.querySelector('img').src = 'https://img.freepik.com/free-photo/dark-abstract-background_1048-1920.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1726876800&semt=ais_hybrid'
   popupEl.querySelector('#nomFr').value = ''
   popupEl.querySelector('#nomAr').value = ''
   popupEl.querySelector('#prix').value = ''
}


const categoriesNav = document.querySelectorAll('.category')
function showPlats(e){

   let id = e.id.replace('category','') || ''
   let category = e.innerHTML;
   console.log(category);
   document.querySelectorAll('.categoriesShow').forEach(a=>{
      a.style.display = 'none'
   })
   document.querySelector('.categoriesShow.'+category).style.display = 'grid'
   categoriesNav.forEach(c=>{
      c.classList.remove('active');
   })
   e.classList.add('active')
   console.log(id);  
}