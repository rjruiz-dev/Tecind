<template>
    <div>
        <article class="post">
            <div class="content-post">

                <post-header :post="post"></post-header>

                <p v-html="post.excerpt"></p>

                <footer class="container-flex space-between">
                    <div class="read-more"> 
                        <post-link class="text-uppercase c-green" :post="post">Leer más</post-link>                                              
                    </div>
                        <div class="tags container-flex">                                
                            <span class="tag c-gris" v-for="tag in post.tags" :key="tag.id">
                                <tag-link :tag="tag"></tag-link>
                                <!-- <router-link :to="{name: 'tags_posts', params: {tag: tag.url }}">
                                    #{{ tag.name }}
                                </router-link> -->
                            </span>                                  
                        </div>
                </footer>
            </div>
        </article>
    </div>
</template>

<script>
    export default {
        props: ['post']
        
    }
</script>