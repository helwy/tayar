<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";

defineProps({
    app_name: String,
    contact_email: String,
});
</script>

<template>
    <div class="h-full w-full">
        <FrontLayout selectedPage="privacy">
            <div class="privacy-policy">
                <h1>Privacy Policy</h1>
                <div><b>Last Updated:</b> YYYY-MM-DD</div>
            </div>
        </FrontLayout>
    </div>
</template>
