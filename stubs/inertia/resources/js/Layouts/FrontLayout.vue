<script setup>
import {getCurrentInstance, onMounted, provide, ref} from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import UserCircleIcon from "@/Components/UserCircleIcon.vue";
import LogoutIcon from "@/Components/LogoutIcon.vue";
import KeyIcon from "@/Components/KeyIcon.vue";
import LoginIcon from "@/Components/LoginIcon.vue";
import UserPlusIcon from "@/Components/UserPlusIcon.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import FrontLanguageSelector from "@/Components/FrontLanguageSelector.vue";
import HomeIcon from "@/Components/HomeIcon.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const props = defineProps(['selectedPage']);

const cookieResponse = document.cookie.split('; ').find(row => row.startsWith('cookie_response='));
const showCookiesModal = ref(!cookieResponse);

const toastMessage = ref('');
const isToastVisible = ref(false);

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

const showToast = (message) => {
    toastMessage.value = message;
    isToastVisible.value = true;
    setTimeout(() => {
        isToastVisible.value = false;
    }, 3000);
};

const instance = getCurrentInstance();
if (instance) {
    instance.appContext.config.globalProperties.$showToast = showToast;
}

const handleKeydown = (event) => {
    if (event.key === 'Escape') {
        if(showLogoutModal.value) {
            showLogoutModal.value = false;
        }
    }
};

onMounted(() => {
    window.addEventListener('keydown', handleKeydown);
});

provide('showToast', showToast);

</script>

<template>
    <Head/>
    <Transition name="toast">
        <div v-if="isToastVisible" class="z-50 fixed p-8 start-0 bottom-0 w-96">
            <div class="bg-black dark:bg-gray-800 text-white px-7 py-5 text-sm rounded">
                {{ toastMessage }}
            </div>
        </div>
    </Transition>
    <div class="bg-white dark:bg-gray-900 text-black/50 dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-primary selection:text-white">
            <div class="relative flex flex-col flex-1 w-full max-w-2xl px-6 lg:max-w-[1288px]">

                <header class="grid grid-cols-[auto_auto] items-center gap-x-2 gap-y-4 py-4 lg:grid-cols-3">
                    <nav class="flex flex-1 gap-4 justify-start order-3 col-span-2 lg:col-span-1 lg:order-1">
                        <Link :href="route('home')"
                              :class="['front-nav front-text p-2 pe-3',
                              selectedPage === 'home' ? 'bg-gray-300 dark:bg-gray-700 rounded-xl' : '']">
                            <HomeIcon class="h-5"/>
                            <p>{{ $t('home') }}</p>
                        </Link>
                    </nav>

                    <div class="flex w-fit lg:w-full lg:justify-center lg:col-start-2 text-primary order-1 lg:order-2">
                        <Link :href="route('home')">
                            <ApplicationLogo />
                        </Link>
                    </div>

                    <nav v-if="$page.props.can_login" class="flex flex-1 flex-wrap gap-4 justify-end order-2 lg:order-3">
                        <template v-if="$page.props.auth.user">
                            <Link :href="route('admin.home')" v-if="$page.props.auth.user.admin" class="front-nav group">
                                <KeyIcon class="front-icon-style" />
                                <p class="front-text">
                                    {{ $t('admin') }}
                                </p>
                            </Link>

                            <Link :href="route('profile.show')"
                                  class="flex items-center gap-x-2 cursor-pointer group">
                                <UserCircleIcon class="front-icon-style" />
                                <p class="front-text max-w-[8rem] lg:max-w-[12rem] truncate">
                                    {{ $page.props.auth.user.name }}
                                </p>
                            </Link>

                            <div class="flex items-center gap-x-2 cursor-pointer group" @click="showLogoutModal = true">
                                <LogoutIcon class="front-icon-style" />
                                <p class="front-text">{{ $t('log_out') }}</p>
                            </div>
                        </template>

                        <template v-else>
                            <Link v-if="$page.props.can_register" :href="route('register')"
                                  class="flex items-center gap-x-2 cursor-pointer group">
                                <UserPlusIcon class="front-icon-style" />
                                <p class="front-text">{{ $t('register') }}</p>
                            </Link>

                            <Link :href="route('login')" class="flex items-center gap-x-2 cursor-pointer group" >
                                <LoginIcon class="front-icon-style" />
                                <p class="front-text">{{ $t('log_in') }}</p>
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6 flex-1 flex flex-col">
                    <slot />
                </main>

                <footer class="py-8 flex flex-wrap items-center justify-center gap-3 text-black dark:text-white">
                    <Link :href="route('privacy')" class="front-link"
                          :class="selectedPage === 'privacy' ? 'underline' : ''">{{ $t('privacy_policy') }}</Link>
                    •
                    <Link :href="route('contact')" class="front-link"
                          :class="selectedPage === 'contact' ? 'underline' : ''">{{ $t('contact.title') }}</Link>
                    •
                    <FrontLanguageSelector />
                    •
                    <DarkModeToggle class="front-link" />
                    <template v-if="$page.props.app_version">
                        •
                        <a :href="$page.props.app_version_link" v-if="$page.props.app_version_link" target="_blank"
                           class="front-link">v{{ $page.props.app_version }}</a>
                        <p v-else class="text-black dark:text-white">v{{ $page.props.app_version }}</p>
                    </template>
                </footer>
            </div>
        </div>

        <div v-if="showCookiesModal" class="cookie-modal">
            <p class="cookie-message">{{ $t('cookies.modal_body') }}</p>
            <div class="cookie-actions">
                <button @click="updateCookieResponse('essential')" class="cookie-btn-essential">
                    {{ $t('cookies.essential_only') }}
                </button>
                <button @click="updateCookieResponse('all')" class="cookie-btn-accept">
                    {{ $t('cookies.accept_all') }}
                </button>
            </div>
        </div>

        <div v-if="showLogoutModal" @click="showLogoutModal = false" class="modal-card">
            <div @click.stop class="modal-card-body">
                <p class="modal-text text-base p-3">{{ $t('auth.confirm_log_out') }}</p>
                <div class="flex justify-end px-1">
                    <div class="flex gap-x-4">
                        <button @click="showLogoutModal = false" class="modal-button">{{ $t('close') }}</button>
                        <button @click="confirmLogout" class="modal-button text-primary">{{ $t('log_out') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
