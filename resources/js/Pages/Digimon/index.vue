<script setup>
import DigimonLayout from "@/Layouts/DigimonLayout.vue";

import DigiGridCard from "./Components/GridCards.vue";
import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, onBeforeUnmount, onUpdated, watch, ref } from "vue";

const props = defineProps({
    request: {
        type: Object,
    },
    digimons: {
        type: Object,
    },
});

var digimonsREST = ref({});
const form = useForm({
    id: "",
}); // Edgar
const formPage = useForm({});
const onPageClick = (event) => {
    formPage.get(route("digimon.index", { page: event }));
};

const closeModal = () => {
    modal.value = false;
    form.reset();
};

const ok = (msj) => {
    form.reset();
    closeModal();
    Swal.fire({ title: msj, icon: "success" });
};

onUpdated(() => {
    digimonsREST.value = digimons.original;
});

watch(
    () => props.digimons,
    (then, now) => {
        digimonsREST = digimons.original;
        console.log(
            "Watch props.selected function called with args:",
            then,
            now
        );
    }
);
</script>

<template>
    <DigimonLayout>
        <Head title="Digimon index" />
        <DigiGridCard :digimons="digimons.original.data"/>
        <div
            class="flex flex-wrap gap-4 pb-10 place-content-center bg-neutral-100 pt-6"
        >
            <VueTailwindPagination
                :current="digimons.original.pagination.currentPage"
                :total="digimons.original.pagination.totalElements"
                :per-page="digimons.original.pagination.elementsOnPage"
                @page-changed="onPageClick($event)"
            />
        </div>
    </DigimonLayout>
</template>
