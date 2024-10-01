

const popupEl = document.querySelector('.popup');



function popup(e) {

   popupEl.style.display = 'grid'
   popupEl.querySelector('#idInp').value = e
   popupEl.querySelector('#nomFr').value = document.getElementById(e).querySelector(`.fr`).innerHTML
   popupEl.querySelector('#nomAr').value = document.getElementById(e).querySelector(`.ar`).innerHTML
   popupEl.querySelector('#prix').value = document.getElementById(e).querySelector(`.price`).innerHTML
   popupEl.querySelector('img').src = document.getElementById(e).querySelector('img').src



}

function closePopup() {
   popupEl.style.display = 'none'
   popupEl.querySelector('#idInp').value = ''
   popupEl.querySelector('img').src = 'https://img.freepik.com/free-photo/dark-abstract-background_1048-1920.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1726876800&semt=ais_hybrid'
   popupEl.querySelector('#nomFr').value = ''
   popupEl.querySelector('#nomAr').value = ''
   popupEl.querySelector('#prix').value = ''
}





document.querySelectorAll('.con input,.con select').forEach(e => {
   e.addEventListener('input', () => {
      setContents()
   })
}
)

// setInterval(() => {

//    setContents()

// }, 1000);
let arr = []





function setContents() {
   console.log('asdkj');

   let con = document.querySelectorAll('.popup .acon');
   let contentsInp = document.querySelector('#contents');
   console.log(con);
   // console.log(con);
   con.forEach(c => {
      console.log(c);
      let p = c.querySelector('select').value;
      let q = c.querySelector('input[type="number"]').value;
      console.log(p, q);
      // p.toString()   
      let obj = { [p]: q }
      if(!Object.keys(obj).includes('') && !Object.values(obj).includes('')){
         arr[p]= obj;
      }


   });
   contentsInp.value = JSON.stringify(arr.filter(n=>n));
   console.log(contentsInp);
   // document.querySelector('form').submit();
}


function addCon() {
   let firstCon = document.querySelectorAll('.acon')[0].innerHTML
   console.log(firstCon);

   let con = document.createElement('div');
   con.classList.add('con')
   con.classList.add('acon')
   con.innerHTML = firstCon
   document.querySelector('.buttons').before(con)

}