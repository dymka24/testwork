<template>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-gray-100  antialiased">
        <h1 class="mb-4 text-5xl text-center mb-10 font-extrabold">Blog Posts</h1>
        <hr>
        <div class="grid grid-cols-4 gap-4 mt-10">
            <div class="col-span-1">
                <label for="lists" class="text-gray-900">Lists</label>
                <select id="lists" v-model="selectedList"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="all" selected>All</option>
                    <option v-for="list in lists" :key="list.id" :value="list.id">{{ list.name }}</option>
                </select>
            </div>
            <div class="col-span-1">
                <label for="users" class="text-gray-900">Users</label>

                <select id="users" v-model="selectedUser"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="all" selected>All</option>
                    <option v-for="user in users" :key="user.id" :value="user.id">{{
                            user.name
                        }}&nbsp;-&nbsp;{{ user.email }}
                    </option>
                </select>
            </div>
            <div class="col-span-1">
                <label for="lists" class="text-gray-900">Social Network</label>
                <select id="lists" v-model="selectedNetwork"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="all" selected>All</option>
                    <option v-for="network in networks" :key="network.id" :value="network.id">{{network.platform}}
                    </option>
                </select>
            </div>
            <div class="col-span-1">
                <label for="lists" class="text-gray-900">Search</label>

                    <input type="search" id="default-search"   v-model="searchInput"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search posts..." >
            </div>

        </div>
        <div class="mt-10" style="max-height: 60vh;overflow-y: auto">
        <div class="grid grid-cols-1 gap-10 w-4/6 m-auto" >
            <div class="col-span-1" v-for="post in posts" :key="post.id">
                <div class="bg-white shadow-md rounded-lg py-5 px-10 hover:shadow-lg transition-shadow duration-150">
                    <h1 class="font-bold underline text-3xl mb-10 text-slate-900" >{{ post.title }}</h1>
                    <div class="flex justify-between items-center mb-5">
                    <h4 class="font-bold">{{ post?.user?.name }}</h4>
                        <h4 class="font-bold">{{ post?.published_at}}</h4>

                    </div>
                    <p class="text-gray-600">{{ post.content }}</p>
                </div>
            </div>
            <div class="col-span-1" v-if="!posts.length">
                <div class="bg-white shadow-md rounded-lg py-5 px-10 hover:shadow-lg transition-shadow duration-150">

                <h1 class="font-bold text-5xl mb-2 text-slate-900 text-center" >No Posts available</h1>
                </div>
            </div>
        </div>
        </div>
    </main>
</template>
<script setup>
import {onMounted, onUpdated, ref, watch, watchEffect} from "vue";
import _ from 'lodash';

const lists = ref([]);
const networks = ref([]);
const users = ref([]);
const posts = ref([]);

const selectedList = ref('all');
const selectedNetwork = ref('all');
const selectedUser = ref('all');
const searchInput = ref('');
const getResources = async () => {
    try {
        const response = await axios.get('/api/resources');
        lists.value = response.data.lists;
        networks.value = response.data.networks;
        users.value = response.data.users;
        await getPosts();

    } catch (e) {
        console.log('error', e)
    }
}
const debouncedGetPosts = _.debounce(() => {
    getPosts();
}, 500);


const getPosts = async () => {
    try {
        const response = await axios.get('/api/posts', {
            params: {
                list_id: selectedList.value,
                user_id: selectedUser.value,
                network_id: selectedNetwork.value,
                search_input:searchInput.value
            }
        });
        posts.value = response.data.posts;

    } catch (e) {
        console.log('error', e)
    }
}
watchEffect(() => {
    if (searchInput.value.length > 2 || searchInput.value.length === 0) { // Optional: Only search when the query is 3 or more characters or empty
        getPosts();
    }
});
const getUsers = async () => {
    try {
        const response = await axios.get('/api/users', {
            params: {
                list_id: selectedList.value,
            }
        });
        users.value = response.data.users;
        await getPosts();

    } catch (e) {
        console.log('error', e)
    }
}
watch(selectedList, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        getUsers();
    }
});
watch(selectedNetwork, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        getPosts();
    }
});
watch(selectedUser, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        getPosts();
    }
});
onMounted(() => {
    getResources();
})
onUpdated(() => {
    console.log('selectedList', selectedList.value)
    console.log('posts', posts.value)
})
</script>
