<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import MoonIcon from "@/Components/MoonIcon.vue";
import SunIcon from "@/Components/SunIcon.vue";

const page = usePage();
const darkMode = ref(page.props.dark_theme);
const iconClasses = ref('text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300');

const toggleMode = () => {
    const theme = darkMode.value === 'dark' ? 'light' : 'dark';
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = "dark_mode" + "=" + theme + ";expires=" + date.toUTCString() + ";path=/";
    axios.post(route('update-theme'), { theme: theme })
        .then(response => {
            if (response.data.status === 'success') {
                location.reload();
            }
        });

};
</script>

<template>
    <button type="button" class="flex items-center" @click="toggleMode">
        <SunIcon v-if="darkMode === 'dark'" :class="iconClasses" />
        <MoonIcon v-else :class="iconClasses" />
    </button>
</template>
