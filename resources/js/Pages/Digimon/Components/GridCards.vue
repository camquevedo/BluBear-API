<script setup>
import DigiCard from './Card.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, onBeforeUnmount } from 'vue';
import ModalComp from '@/Components/Modal.vue';
// import Modal from 'vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Modal.vue';
import VueTailwindModal from '@ocrv/vue-tailwind-modal'
import { ref } from 'vue';

// const digimonForm = useForm({
//     email: '',
//     password: '',
//     remember: false,
// });

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
const modal = ref(false);
const props = defineProps({
    digimons: {
        type: Array,
        required: true,
        default: [
            {
                id: 1,
                level: 1
            },
            {
                id: 3
            },
            {
                id: 5,
                type: 'azul'
            },
        ]
    },
});

const openModal = (op, digimonDetail) => {
    modal.value = true;
}
const closeModal = (op, digimonDetail) => {
    modal.value = false;
}

const read = (id) => {
    // form.get(route('digimon.getByParameter'))
    digimonForm.post(route('digimon.getByParameter')),{
        onSuccess: () => {ok('Digimon leido')}
    }
}

const ok = (msj) => {
    closeModal();
}

onMounted(() => {
//   console.log(`the component is now mounted.`)
});

onBeforeUnmount(() => {});
</script>
<template>
    <Head title="DigiGridCard" />
    <div class="flex flex-wrap gap-4 pb-10 place-content-center bg-neutral-100 pt-6">
        <DigiCard v-for="digimon in digimons" :digimon="digimon" :detailsFlag="false" />
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
