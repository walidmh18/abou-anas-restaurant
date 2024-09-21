const popupEl = document.querySelector('.popup')

function popup(e){
   console.log(e);
   popupEl.querySelector('#orderId').value = e.id;
   
   popupEl.style.display='grid'



}