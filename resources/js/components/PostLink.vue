<template>
    <div>
        <router-link          
            :to="{
                name: 'posts_show', 
                params: {
                    url: post.url 
                }
            }"
            class="text-uppercase c-green">
         <slot />
        </router-link>
    </div>
</template>

<script>
    export default {
        props: ['post']
    }
</script>