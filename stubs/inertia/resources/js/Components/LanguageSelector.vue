<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const page = usePage();
const currentLocale = ref(page.props.current_locale);
const availableLocales = ref(page.props.available_locales);

const updateLocale = (locale) => {
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = "language_code" + "=" + locale + ";expires=" + date.toUTCString() + ";path=/";
    axios.post(route('update-locale'), { locale: locale })
        .then(response => {
            if (response.data.status === 'success') {
                location.reload();
            }
        });
};
</script>

<template>
    <Dropdown align="right" width="32">
        <template #trigger>
            <span class="inline-flex rounded-md">
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                    {{ availableLocales[currentLocale] }}

                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </span>
        </template>

        <template #content>
            <form @submit.prevent="updateLocale(code)" v-for="(locale, code) in availableLocales" :key="code">
                <DropdownLink as="button" :disabled="code === currentLocale">{{ locale }}</DropdownLink>
            </form>
        </template>
    </Dropdown>
</template>
