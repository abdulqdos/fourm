<template>
   <AppLayout>
        <ul>
            <Container>
                <div class="divide-y">
                    <li v-for="post in posts.data" :key="post.id" class="px-2 py-4 font-bold ">
                        <p> {{ post.title }} </p>
                    </li>
                </div>
            </Container>
        </ul>
       <pagination :meta="posts.meta"></pagination>
   </AppLayout>
</template>

<script setup lang="ts">
    import Container from "@/Layouts/Container.vue";
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from "@/Components/pagination.vue";

    defineProps(['posts']);
</script>
