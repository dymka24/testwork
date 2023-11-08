<template>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-gray-100 dark:bg-gray-900 antialiased">
        <h1 class="mb-4 text-5xl font-extrabold">Blog Posts</h1>

    </main>
</template>
<script setup>
import {onMounted} from "vue";
    const apiRequest=async ()=>{
        try {
            const response=await axios.get('/api/resources');
            console.log('response',response)
        }catch (e) {
            console.log('error',e)
        }
    }
onMounted(() => {
    apiRequest();
})
</script>
