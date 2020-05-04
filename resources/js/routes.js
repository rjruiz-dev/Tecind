// En caso de proporcionar fallas desinstalar vue-router, browersync y borrar
// Borrar 
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: ('Home',  require('./views/Home.vue').default)
        },
        {
            path: '/nosotros',
            name: 'about',
            component: ('About',  require('./views/About.vue').default)
        },
        {
            path: '/archivo',
            name: 'archive',
            component: ('Archive',  require('./views/Archive.vue').default)
        },
        {
            path: '/contacto',
            name: 'contact',
            component: ('Contact',  require('./views/Contact.vue').default)
        },
        {
            path: '/blog/:url',
            name: 'posts_show',
            component: ('PostsShow',  require('./views/PostsShow.vue').default),
            props: true
        },
        {
            path: '/categorias/:category',
            name: 'category_posts',
            component: ('CategoryPosts',  require('./views/CategoryPosts.vue').default),
            props: true
        },
        {
            path: '/etiquetas/:tag',
            name: 'tags_posts',
            component: ('TagsPosts',  require('./views/TagsPosts.vue').default),
            props: true
        },
        {
            path: '*',           
            component: ('404',  require('./views/404.vue').default)
        }       
    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior(){
        return {x:0, y:0};
    }
});
// hasta aca