/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//NOTIFICATONS
Vue.component('popup-notification', require('./components/PopUpNotification.vue').default);
Vue.component('i-coach-notification', require('./components/IamYourCoachNotification.vue').default);

Vue.component('confirm-profp', require('./components/ConfirmProfP.vue').default);
Vue.component('confirm-assist', require('./components/ConfirmAssist.vue').default);
//Vue.component('confirm-userprof', require('./components/ConfirmUserProf.vue').default);

//CHAT
Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('mobilechat', require('./components/MobileChat.vue').default);

//MENU
Vue.component('drop-down-select', require('./components/DropDownSelect.vue').default);
Vue.component('drop-down-create', require('./components/DropDownCreate.vue').default);
Vue.component('drop-down-edit', require('./components/DropDownEdit.vue').default);

//PROFILE
Vue.component('add-skill', require('./components/AddSkill.vue').default);

//Conversation dialogs
Vue.component('signaler-reason', require('./components/SignalerReason').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

const drop = new Vue({
    el: '#drop',
});

const pop = new Vue({
    el: '#pop',
});

const popassist = new Vue({
    el: '#popassist',
});

const chat = new Vue({
    el: '#chat',
});
