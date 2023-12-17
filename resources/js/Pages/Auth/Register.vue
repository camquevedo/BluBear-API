<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    details: {
        firstName: "",
        lastName: "",
        email: "",
    },
    properties: {
        password: "",
        passwordConfirmation: "",
    },
});
const operation = ref(1);

const submit = () => {
    if(operation.value == 1){
        form.post(route('users.register'),{
            onSuccess: (resp) => {
                ok(resp);
            },
        });
    }
    else{
        form.put(route('users.update',id.value),{
            onSuccess: (resp) => {
                ok(resp);
            },
        });
    }
};
const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="firstName" value="Firstt Name" />

                <TextInput
                    id="firstName"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.details.firstName"
                    required
                    autofocus
                    autocomplete="firstName"
                />

                <InputError class="mt-2" :message="form.errors.firstName" />
            </div>

            <div class="mt-4">
                <InputLabel for="lastName" value="Last Name" />

                <TextInput
                    id="lastName"
                    type="text"
                    class="mt-2 block w-full"
                    v-model="form.details.lastName"
                    required
                    autofocus
                    autocomplete="lastName"
                />

                <InputError class="mt-2" :message="form.errors.lastName" />
            </div>

            <div class="mt-4">
                <InputLabel for="details.email" value="Email" />

                <TextInput
                    id="details.email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.details.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="properties.password" value="Password" />

                <TextInput
                    id="properties.password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.properties.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="properties.passwordConfirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="properties.passwordConfirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.properties.passwordConfirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.passwordConfirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
