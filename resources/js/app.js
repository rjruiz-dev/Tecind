
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.$ = window.jQuery = require('jquery');


window.Vue = require('vue');

import Vue from 'vue';
import router from './routes';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('nav-bar',        require('./components/NavBar.vue').default);
Vue.component('tag-link',       require('./components/TagLink.vue').default);
Vue.component('paginator',      require('./components/Paginator.vue').default);
Vue.component('dashboard',      require('./components/Dashboard.vue').default);
Vue.component('post-link',      require('./components/PostLink.vue').default);
Vue.component('posts-list',     require('./components/PostsList.vue').default);
Vue.component('post-header',    require('./components/PostHeader.vue').default);
Vue.component('social-links',   require('./components/SocialLinks.vue').default);
Vue.component('contact-form',   require('./components/ContactForm.vue').default);
Vue.component('notification',   require('./components/Notification.vue').default);
Vue.component('category-link',  require('./components/CategoryLink.vue').default);
Vue.component('posts-list-item',require('./components/PostsListItem.vue').default);
Vue.component('disqus-comments',require('./components/DisqusComments.vue').default);
Vue.component('pagination-links',require('./components/PaginationLinks.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',  
    // borrar  
    router,
    // hasta aca
    data: {
        notifications: []
    },    
    created() {             
        let me = this;      
        axios.get('/admin/notification/get').then(function(response){
            // console.log(response.data);            
            me.notifications=response.data;
        }).catch(function(error){
            console.log(error);        
        }); 
        //en la var se almacena el id que se captura a traves de la etiqueta meta
        // se obtiene el id del usuario q trabaja con el sist
        var userId = $('meta[name="userId"]').attr('content'); 
        // escucha los evento de transmision de echo
        Echo.private('App.User.' + userId).notification((notification) => {
            // cada ves que alla una nueva orden se notificara
            // con unshif se agrega al inicio del arreglo    
            me.notifications.unshift(notification);
        });    
    }
});
