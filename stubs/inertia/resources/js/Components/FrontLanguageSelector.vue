<script setup>
import {ref, onMounted, onUnmounted} from 'vue';
import {usePage} from "@inertiajs/vue3";

const page = usePage();
const currentLocale = ref(page.props.current_locale);
const availableLocales = ref(page.props.available_locales);
const showLanguageDropdown = ref(false);
const languageButton = ref(null);
const languageDropdown = ref(null);

const toggleLanguageDropdown = () => {
    showLanguageDropdown.value = !showLanguageDropdown.value;
};

const selectLocale = (locale) => {
    if (locale !== currentLocale.value) {
        const date = new Date();
        date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
        document.cookie = "language_code" + "=" + locale + ";expires=" + date.toUTCString() + ";path=/";
        if (page.props.auth.user) {
            axios.post(route('update-locale'), {locale: locale})
                .then(response => {
                    if (response.data.status === 'success') {
                        location.reload();
                    }
                });
        } else {
            location.reload();
        }
    }

    showLanguageDropdown.value = false;
};

const handleClickOutside = (event) => {
    if (languageButton.value && !languageButton.value.contains(event.target) &&
        languageDropdown.value && !languageDropdown.value.contains(event.target)) {
        showLanguageDropdown.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});
onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="relative flex">
        <button class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer"
                ref="languageButton" @click="toggleLanguageDropdown">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
            </svg>
        </button>

        <div
            class="absolute right-1/2 translate-x-1/2 mt-8 w-auto min-w-fit bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700"
            v-if="showLanguageDropdown" ref="languageDropdown">
            <ul class="py-1">
                <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-zinc-700 cursor-pointer flex items-center whitespace-nowrap"
                    v-for="(locale, code) in availableLocales" :key="code" @click="selectLocale(code)">
                    <span :class="{ 'text-black dark:text-white': currentLocale === code,
                      'text-gray-600 dark:text-gray-300': currentLocale !== code }">
                        {{ locale }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>
