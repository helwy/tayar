<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import UserCircleIcon from "@/Components/UserCircleIcon.vue";
import LogoutIcon from "@/Components/LogoutIcon.vue";
import KeyIcon from "@/Components/KeyIcon.vue";
import LoginIcon from "@/Components/LoginIcon.vue";
import UserPlusIcon from "@/Components/UserPlusIcon.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import FrontLanguageSelector from "@/Components/FrontLanguageSelector.vue";

const cookieResponse = document.cookie.split('; ').find(row => row.startsWith('cookie_response='));
const showCookiesModal = ref(!cookieResponse);

const updateCookieResponse = (cookieResponse) => {
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = "cookie_response" + "=" + cookieResponse + ";expires=" + date.toUTCString() + ";path=/";
    showCookiesModal.value = false;
};

const showLogoutModal = ref(false);

const confirmLogout = () => {
    router.post(route('logout'));
    showLogoutModal.value = false;
};
</script>

<template>
    <Head title="Welcome"/>
    <div class="bg-gradient-to-tl from-green-300 to-white dark:from-green-950 dark:to-black text-black/50 dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2 text-[#FF2D20]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                        </svg>
                    </div>
                    <nav v-if="$page.props.can_login" class="flex flex-1 gap-4 justify-end">
                        <FrontLanguageSelector />

                        <DarkModeToggle icon-classes="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer" />

                        <template v-if="$page.props.auth.user">
                            <Link :href="route('admin.home')" v-if="$page.props.auth.user.admin"
                                  :title="$page.props.auth.user.name">
                                <KeyIcon class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer" />
                            </Link>

                            <Link :href="route('profile.show')" :title="$page.props.auth.user.name">
                                <UserCircleIcon class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80" />
                            </Link>

                            <div :title="$t('log_out')">
                                <LogoutIcon class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80 cursor-pointer" @click="showLogoutModal = true" />
                            </div>
                        </template>

                        <template v-else>
                            <Link v-if="$page.props.can_register" :href="route('register')" :title="$t('register')">
                                <UserPlusIcon class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80" />
                            </Link>

                            <Link :href="route('login')" :title="$t('log_in')" >
                                <LoginIcon class="text-black hover:text-black/70 dark:text-white dark:hover:text-white/80" />
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <slot/>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                </footer>
            </div>
        </div>

        <div
            v-if="showCookiesModal"
            class="flex flex-col lg:flex-row justify-between items-center gap-4 lg:gap-8 fixed bottom-16 left-1/2 transform -translate-x-1/2 bg-white dark:bg-zinc-900 shadow-lg rounded-lg p-4 lg:px-8 max-w-xl lg:max-w-6xl w-full text-center">
            <p class="text-sm text-gray-800 dark:text-gray-200 mb-4">
                {{ $t('cookies.modal_body') }}
            </p>
            <div class="flex lg:flex-col w-full lg:w-fit justify-between gap-4 shrink-0">
                <button
                    @click="updateCookieResponse('essential')"
                    class="bg-gray-800 dark:bg-gray-200 border text-white dark:text-gray-800 uppercase hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none text-sm py-2 px-4 rounded">
                    {{ $t('cookies.essential_only') }}
                </button>
                <button
                    @click="updateCookieResponse('all')"
                    class="bg-green-700 hover:bg-green-800 text-white uppercase text-sm py-2 px-4 rounded">
                    {{ $t('cookies.accept_all') }}
                </button>
            </div>
        </div>

        <div v-if="showLogoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click="showLogoutModal = false">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg p-6 max-w-sm w-full" @click.stop>
                <p class="text-center text-lg text-black dark:text-white mb-4">
                    {{ $t('auth.confirm_log_out') }}
                </p>
                <div class="flex justify-between">
                    <button @click="showLogoutModal = false" class="bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded">
                        {{ $t('close') }}
                    </button>
                    <button @click="confirmLogout" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                        {{ $t('log_out') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
