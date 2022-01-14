<template>

    <section class="max-w-4xl p-6 mx-auto bg-white dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Ajouter un client</h2>
        <div class="text-red-500" v-if="errors !== ''">
            {{ errors }}
        </div>
        <form @submit.prevent="saveDrink">
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="name">Nom</label>
                    <input v-model="drink.name" id="name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>
              <div>
                <label for="price" class="block text-sm font-medium text-gray-700">
                  Prix du cassier
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    FCFA
                  </span>
                  <input v-model="drink.price" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                </div>
              </div>

              <div>
                <label class="text-gray-700 dark:text-gray-200" for="quantity">Quantité de cassier</label>
                <input v-model="drink.quantity" disabled id="quantity" type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600">Modifier</button>
            </div>
            </div>
        </form>
    </section>

</template>

<script>
import { onMounted } from 'vue';
import useDrinks from "../../services/drinkservices.js";

export default {
    props: {
          id : {
              required: true,
              type: String
          }
      },

    setup(props){

        const { getDrink, drink, updateDrink, errors } = useDrinks();

        onMounted(getDrink(props.id));

        const saveDrink = async () => {
            await updateDrink(props.id) ;
        };
        return{
            drink,
            saveDrink,
            errors
        }
    },

    methods: {
        
    }
}
</script>