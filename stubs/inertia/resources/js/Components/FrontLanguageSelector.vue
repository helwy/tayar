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
        <button class="front-link" ref="languageButton" @click="toggleLanguageDropdown">
            <p>{{ availableLocales[currentLocale] }}</p>
        </button>

        <div
            class="absolute right-1/2 translate-x-1/2 bottom-full mb-2 w-auto min-w-fit bg-white dark:bg-zinc-800
                rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 z-10"
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
