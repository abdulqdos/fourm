<template>
    <div class="sm:flex">
        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
            <img :src="comment.user.profile_photo_url" class="h-10 w-10 rounded-full" />
        </div>
        <div>
            <p class="mt-1 break-all">{{ comment.body }}</p>
            <span class="first-letter:uppercase block pt-1 text-xs text-gray-600">By {{ comment.user.name }} {{ relativeDate(comment.created_at) }} ago</span>
            <div class="mt-1 flex flex-row justify-end items-center gap-4">
                <form  @submit.prevent="$emit('delete' , comment.id)" v-if="comment.can?.delete" class="empty:hidden flex flex-row justify-end items-center gap-4">
                    <button class="font-mono bg-red-600 hover:bg-red-700 transition duration-300 cursor-pointer text-white px-3 py-1 rounded-md">Delete</button>
                </form>
                <form  @submit.prevent="$emit('edit' , comment.id)" v-if="comment.can?.update" class="empty:hidden flex flex-row justify-end items-center gap-4">
                    <button class="font-mono bg-blue-600 hover:bg-blue-700 transition duration-300 cursor-pointer text-white px-3 py-1 rounded-md">Edit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import {relativeDate} from "@/Utilities/date.js";
import {router, usePage} from "@inertiajs/vue3";
// import {computed} from "vue";

const props = defineProps(['comment']);
const emit = defineEmits(['delete' , 'edit']);

</script>
