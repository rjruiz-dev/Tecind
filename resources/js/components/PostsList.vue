<template>
    <div>
        <section class="posts container">  
            
            <posts-list-item 
                v-for="post in items" 
                :post="post" 
                :key="post.id">                   
            </posts-list-item>
            
            <article class="post" v-if="! items.length">
                <div class="content-post">                            
                    <h1>No hay publicaciónes todavia.</h1>                    
                </div>
            </article>    
        </section>
    </div>
</template>

<script>
    export default {
        props: ['items']
        
    }
</script>