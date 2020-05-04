<template>
    <div>
         <paginator 
                :url="`/api/categorias/${this.category}`" 
                component-name="posts-list">
        </paginator> 
       <!-- <posts-list :posts="posts"></posts-list> -->
    </div>
</template>

<script>
    export default {
        props: ['category']
        // data(){
        //     return {
        //         posts: []
        //     }
        // },
        // mounted(){
        //     // Obtener los posts
        //     axios.get(`/api/categorias/${this.category}`)
        //         .then(res => {
        //             this.posts = res.data.data;
        //         })
        //         .catch(err => {
        //             console.log(err);
        //         });
        // }
    }
</script>