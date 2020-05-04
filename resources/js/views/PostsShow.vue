<template>
    <div>
        <section class="post container">
          
            <div class="content-post">
                
                <post-header :post="post"></post-header>              

                <div class="image-w-text" v-html="post.body">
                    {{ post.photos}}
                   
                </div>
                <footer class="container-flex space-between">
                    <social-links :description="post.body"></social-links>

                    <div class="tags container-flex">                                
                        <span class="tag c-gris" v-for="tag in post.tags" :key="tag.id">
                            <tag-link :tag="tag"></tag-link>                           
                        </span>                                  
                    </div>
                </footer>
                <div class="comments">
                    <div class="divider"></div>
                        <disqus-comments> </disqus-comments>
                       
                </div><!-- .comments -->
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['url'],
        data(){
            return {
                post: {
                    owner:{},
                    category: {}
                }
            }
        },
        mounted(){
            axios.get(`/api/blog/${this.url}`)
                .then(res => {
                   this.post = res.data;
                })
                .catch(err => {
                    console.log(err.response.data);
                });
        }
    }
</script>