<template>
<section class="max-w-4xl p-6 mx-auto bg-white dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Ajouter un fournisseur</h2>
        <div class="text-red-500" v-if="errors !== ''">
            {{ errors }}
        </div>
        <form @submit.prevent="storeProvider">
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="name">Nom</label>
                    <input v-model="form.name" id="name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="contact">Contact</label>
                    <input v-model="form.contact" id="contact" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600">Ajouter</button>
            </div>
        </form>
    </section>
</template>

<script>
import { reactive } from 'vue';
import useProviders from "../../services/providerservices.js";
import router from "../../router/index.js";

export default {
    setup(){
        const form = reactive({
            name: '',
            contact: '',
        });

        const { createProvider, errors } = useProviders();

        const storeProvider = async () => {
            await createProvider({...form});
            router.push({name: 'providers'});
        }

        return{
            form,
            errors,
            storeProvider,
        }
    }
}
</script>