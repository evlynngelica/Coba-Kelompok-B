const menu = document.getElementById('menu-label');
const sideBar = document.getElementsByClassName('sidebar')[0];

menu.addEventListener('click',function(){
    sideBar.classList.toggle('hide');
    console.log('aktif')

})