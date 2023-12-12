<script setup>
defineProps({
    digimon: {
        type: Object,
        required: true,
        default: {
            id: null,
            name: null,
            level: null,
            attribute: null,
            type: null,
            image: null
        }
    },
    status: {
        type: String,
    },
});
</script>
<template>
    <div class="flex flex-wrap min-w-min max-w-sm rounded overflow-hidden shadow-lg place-content-center my-4 py-4 bg-white">
        <!-- <p>{{digimon}}</p> -->
        <div class="max-w-1/2 grid grid-cols-1 place-content-center ">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 flex items-center justify-center">
                {{ digimon.id ?? "digi-id" }}
            </span>
            <div class="font-bold text-3xl mb-2">{{ digimon.name ?? "misigno" }}</div>
        </div>
        <img class="w-full" :alt="digimon.name ?? 'Sunset in the mountains'"
            :src="digimon.image ?? 'https://digi-api.com/images/digimon/w/Garummon.png'">
        <div class="flex mb-4 w-4/5">
            <div class="w-1/3 min-h-min min-w-5 bg-digimon-logo-3 grid grid-cols-1 wrap items-center justify-center" v-for="propery in [{id: 'Level', value:digimon.level}, {id: 'Attribute', value:digimon.attribute}, {id: 'Type', value:digimon.type}]">
                <div class="mx-auto py-1">{{ propery.id }}</div>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mx-2 mb-2 flex items-center justify-center">
                {{ propery.value ?? "..." }}
            </span>
            </div>
        </div>
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
