<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

import DigiGridCards from "./Components/GridCards.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
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
// const digimons = [
//     {
//         id: 5,
//         type: 'azul'
//     },
//     {
//         id: 1,
//         level: 1
//     },
//     {
//         id: 3,
//         attribute: 'Navidad'
//     },
// ];
const form = useForm({
    id: "",
}); // Edgar
const formPage = useForm({
    id: null,
});
const onPageClick = (event) => {
    formPage.get(route("digimon.index", { page: event }));
};
// const openModal = (op, digimonDetail) => {
//     modal.value = true;
// }
const openModal = (op, name, email, phone, department, employee) => {
    modal.value = true;
    nextTick(() => nameInput.value.focus());
    operation.value = op;
    id.value = employee;
    if (op == 1) {
        title.value = "Create employee";
    } else {
        title.value = "Edit employee";
        form.name = name;
        form.email = email;
        form.phone = phone;
        form.department_id = department;
    }
};
// const closeModal = (op, digimonDetail) => {
//     modal.value = false;
// }
const closeModal = () => {
    modal.value = false;
    form.reset();
};

const save = () => {
    if (operation.value == 1) {
        form.post(route("employees.store"), {
            onSuccess: () => {
                ok("Employee created");
            },
        });
    } else {
        form.put(route("employees.update", id.value), {
            onSuccess: () => {
                ok("Employee updated");
            },
        });
    }
};
const ok = (msj) => {
    form.reset();
    closeModal();
    Swal.fire({ title: msj, icon: "success" });
};
const deleteEmployee = (id, name) => {
    const alerta = Swal.mixin({
        buttonsStyling: true,
    });
    alerta
        .fire({
            title: "Are you sure delete " + name + " ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-check"></i> Yes,delete',
            cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancel',
        })
        .then((result) => {
            if (result.isConfirmed) {
                form.delete(route("employees.destroy", id), {
                    onSuccess: () => {
                        ok("Employee deleted");
                    },
                });
            }
        });
};

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
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
    <GuestLayout>
        <Head title="Log in" />
        <p>{{ digimonsREST.value }}</p>
        <p>{{ digimons.original.pagination }}</p>
        <DigiGridCards :digimons="digimons.original.data" />
        <!-- <VueTailwindPagination :current="digimons" :total="digimons" /> -->
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
    </GuestLayout>
</template>
