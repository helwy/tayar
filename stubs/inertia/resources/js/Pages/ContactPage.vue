<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import {computed} from "vue";

const props = defineProps({
    app_name: String,
    contact_email: String,
    github: String,
    linkedin: String,
    mastodon: String,
    bluesky: String,
    threads: String,
    twitter: String,
});

const hasSocialLinks = computed(() => {
    return props.linkedin || props.mastodon || props.bluesky || props.threads || props.twitter;
});
</script>

<template>
    <div class="h-full w-full">
        <FrontLayout selectedPage="contact">
            <div class="contact-div">
                <h1>{{ $t('contact.title') }}</h1>
                <div v-if="contact_email">
                    {{ $t('contact.email') }}: <a :href="'mailto:' +  contact_email + '?subject=[' + app_name + ' v' + $page.props.app_version + '] Support Request'">{{ contact_email }}</a>
                </div>
                <div v-if="github">
                    {{ $t('contact.github_repo') }}: <a :href="github">{{ github }}</a>
                </div>
                <div v-if="hasSocialLinks">
                    <p>{{ $t('contact.connect') }}</p>
                </div>
                <ul v-if="hasSocialLinks">
                    <li v-if="linkedin"><a :href="linkedin" target="_blank">LinkedIn</a></li>
                    <li v-if="mastodon"><a :href="mastodon" target="_blank">Mastodon</a></li>
                    <li v-if="bluesky"><a :href="bluesky" target="_blank">Bluesky</a></li>
                    <li v-if="threads"><a :href="threads" target="_blank">Threads</a></li>
                    <li v-if="twitter"><a :href="twitter" target="_blank">Twitter/X</a></li>
                </ul>
            </div>
        </FrontLayout>
    </div>
</template>
