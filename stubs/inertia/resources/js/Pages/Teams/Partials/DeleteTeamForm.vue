<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    team: Object,
});

const confirmingTeamDeletion = ref(false);
const form = useForm({});

const confirmTeamDeletion = () => {
    confirmingTeamDeletion.value = true;
};

const deleteTeam = () => {
    form.delete(route('teams.destroy', props.team), {
        errorBag: 'deleteTeam',
    });
};
</script>

<template>
    <ActionSection>
        <template #title>
            {{ $t('teams.delete') }}
        </template>

        <template #description>
            {{ $t('teams.delete_description') }}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ $t('teams.delete_content') }}
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmTeamDeletion">
                    {{ $t('teams.delete') }}
                </DangerButton>
            </div>

            <!-- Delete Team Confirmation Modal -->
            <ConfirmationModal :show="confirmingTeamDeletion" @close="confirmingTeamDeletion = false">
                <template #title>
                    {{ $t('teams.delete') }}
                </template>

                <template #content>
                    {{ $t('teams.delete_confirmation') }}
                </template>

                <template #footer>
                    <SecondaryButton @click="confirmingTeamDeletion = false">
                        {{ $t('cancel') }}
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteTeam"
                    >
                        {{ $t('teams.delete') }}
                    </DangerButton>
                </template>
            </ConfirmationModal>
        </template>
    </ActionSection>
</template>
