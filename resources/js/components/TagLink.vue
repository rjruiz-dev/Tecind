<template>
    <div>
        <router-link :to="{
            name: 'tags_posts', 
            params: {
                tag: tag.url 
                }
            }">#{{ tag.name }}
        </router-link>
    </div>
</template>

<script>
    export default {
        props:['tag']
    }
</script>