<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <FrontLayout>
        <div
            id="docs-card"
            class="flex flex-col items-center justify-center gap-6 overflow-hidden rounded-lg bg-white h-96 p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="relative flex items-center lg:items-end">
                <h2 class="text-xl text-black dark:text-white">{{ $t('welcome_to_tayar') }}</h2>
            </div>
        </div>
    </FrontLayout>
</template>
