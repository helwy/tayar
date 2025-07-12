<script setup lang="ts">
import FrontLayout from "@/Layouts/FrontLayout.vue";
import { computed } from 'vue';
import {trans} from "laravel-vue-i18n";

const props = defineProps({
    app_name: String,
    github: String,
});

const processIntroText = computed(() => {
    const rawText = trans('guest.introduction');

    const link1Regex = /%1(.*?)%/g;
    let processedText = rawText.replace(link1Regex, '<a href="' + props.github + '" class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer underline">$1</a>');

    const link2Regex = /%2(.*?)%/g;
    processedText = processedText.replace(link2Regex, '<a href="' + route('contact') + '" class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer underline">$1</a>');

    return processedText;
});
</script>

<template>
    <FrontLayout selectedPage="home">
        <div class="w-full flex flex-1 justify-center items-center h-full m-2">
            <div class="w-full max-w-2xl">
                <div class="bg-yellow-300 dark:bg-gray-950 shadow-lg rounded-lg p-8 text-gray-800 dark:text-gray-300 space-y-4">
                    <h1 class="text-2xl font-bold">{{ app_name }}</h1>
                    <p v-html="processIntroText"></p>
                    <p>{{ $t('guest.instructions' )}}</p>
                </div>
            </div>
        </div>
    </FrontLayout>
</template>
