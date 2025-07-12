<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    iconClasses: {
        type: String,
        default: "text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300",
    }
});

const page = usePage();
const darkMode = ref(page.props.dark_theme);

const toggleMode = () => {
    const theme = darkMode.value === 'dark' ? 'light' : 'dark';
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = "dark_theme" + "=" + theme + ";expires=" + date.toUTCString() + ";path=/";
    if(page.props.auth.user) {
        axios.post(route('update-theme'), { theme: theme })
            .then(response => {
                if (response.data.status === 'success') {
                    location.reload();
                }
            });
    } else {
        location.reload();
    }
};
</script>

<template>
    <button type="button" @click="toggleMode">
        <p v-if="darkMode === 'dark'">{{ $t('light_mode') }}</p>
        <p v-else>{{ $t('dark_mode') }}</p>
    </button>
</template>
