<template>
    <div>
        <router-link 
        :to="{
            name: 'category_posts', 
            params: {
                category: category.url 
            }
        }">{{ category.name }}
        </router-link>
    </div>
</template>

<script>
    export default {
        props: ['category']
    }
</script>