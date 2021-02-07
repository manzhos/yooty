const filterToggle = document.querySelector('#filter-togle');
const filterContainer = document.querySelector('#filter-screen');
const messageContainer = document.querySelector('#message-screen');

filterToggle.onclick = function(){
    filterToggle.classList.toggle('filter-icon-active');
    filterContainer.classList.toggle('filter--active');
    messageContainer.classList.toggle('message-screen--filter-active');
}
