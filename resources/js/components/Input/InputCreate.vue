<template>
<AddPerson :open="show_a_p" :toogleModal="toogleModal" :addType="'Fournisseur'" :provider="currentProvider" :add="addProvider" />
  <div class="font-light text-red-500 text-sm p-2 bg-red-100" v-if="m_error != ''">
    <span>{{ m_error }}</span>
  </div>
  <div class="flex justify-between w-full mx-auto px-4 py-6 overflow-x-scroll">
    <div class="shadow-lg shadow-blue-200/50 w-full mx-2 p-4 rounded-lg">
      <div class="flex justify-between w-full">
        <div>
        <h1 class="text-xl font-semibold">
        Listes des boissons
      </h1>
      </div>
      <div class="relative">
          <span class="absolute mt-3 ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchDrink" placeholder="Rechercher une boisson"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
      </div>
      </div>
      <div class="flex flex-col mt-2">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">     
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg h-128 overflow-y-scroll">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Prix du cassier
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" v-if="currentDrink.id != ''">
                Quantité en cassier
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Action</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" v-for="drink in filteredDrink" :key="drink.id">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                <img class="h-8 w-8 rounded-full" src="../../../../public/img/default-img.png" alt="">
                </div>
                <div class="ml-4">
                <div class="text-sm font-medium text-gray-900 uppercase font-semibold">
                    {{ drink.name }}
                </div>
                </div>
            </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ drink.price }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap" v-if="currentDrink.id != ''">
                <div class="mt-2 flex rounded-md shadow-sm" v-if="currentDrink.id === drink.id">
                  <input v-model="drink.quantity" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300">
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button @click="insertQuantity(drink)" v-if="currentDrink.id == drink.id" class="px-2 py-1 ml-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">  Valider </button>
                <button @click="showInput(drink)" v-else class="px-2 py-1 ml-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Ajouter</button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="shadow-lg shadow-blue-200/50 w-full mx-2 p-4 rounded-lg">
      <div>
        <h1 class="text-xl font-semibold">
        Informations sur l'Entrée
      </h1>
      </div>
      <div class="mt-2 relative">
        <label for="first-name" class="block text-sm font-light text-gray-700">Nom du fournisseur</label>
        <input type="text" v-model="searchProvider" @change="checkProvider" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <div class="bg-gray-50 border border-gray-100 shadow-md rounded-md w-full absolute" v-if="searchProvider != '' && searchProvider != currentProvider.name" >
          <ul v-for="provider in filteredProvider" :key="provider.id">
              <li @click="selectProvider(provider)" class="p-2 border-b border-gray-300 text-sm cursor-pointer text-gray-500 hover:bg-gray-200 hover:text-gray-600">
                  {{ provider.name }}
              </li>
          </ul>
      </div>
      <!-- <div  class="hidden">
          
      </div> -->
      <div class="bg-gray-50 border border-gray-100 shadow-md rounded-md w-full absolute" v-if="searchProvider  != '' && filteredProvider.length == [] ">
          <ul>
              <li class="p-2 border-b border-gray-300 text-sm cursor-pointer text-gray-500 hover:bg-gray-200 hover:text-gray-600" @click="toogleModal">
                  Ajouter le fournisseur "{{ searchProvider }}"
              </li>
          </ul>
      </div>
      </div>
      <div class="mt-2 p-2">
        <div>
           <h1 class="font-light text-md">
            Listes des boissons
          </h1>
        </div>
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg h-80 overflow-y-scroll">
                <table class="min-w-full divide-y divide-gray-200">
                  <tbody class="bg-white divide-y divide-gray-200" v-for="drink in drinkList" :key="drink.id">
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900 uppercase">
                              {{ drink.name }}
                            </div>
                            <div class="text-sm text-gray-500">
                              {{ drink.price }} FCFA 
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap" v-if="show_m_field">
                        <div class="mt-2 flex rounded-md shadow-sm">
                          <input v-model="drink.quantity" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300">
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap" v-else>
                        <div class="text-sm text-gray-900">{{ drink.quantity }} Cassier<span v-if="drink.quantity > 1">s</span></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          {{ parseFloat(drink.quantity) * parseFloat(drink.price) }} FCFA
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button @click="validateModifyInput(drink)" class="text-indigo-600 hover:text-indigo-900" v-if="show_m_field">Valider</button>
                        <button @click="showModifyInput(drink)" class="text-indigo-600 hover:text-indigo-900" v-else>Modifier</button>
                        <button @click="removeDrink(drink)" class="text-red-600 ml-1 hover:text-red-900">Retier</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="flex w-full justify-end mt-3 items-center">
          <label class="font-bold mr-2">Montant Total:</label>
          <div class="mt-1 flex rounded-md shadow-sm">
                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    FCFA
                  </span>
                  <input v-model="sum" readonly type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                </div>
      </div>
      <div class="mt-4">
        <button class="px-3 py-2 text-center w-full bg-blue-500 text-white rounded-md">Enregistrer</button>
      </div>
  </div>
    </div>
  </div>

</template>

<script>
import { reactive } from 'vue';
import useDrinks from "../../services/drinkservices.js";
import useInputs from "../../services/inputservices.js";
import useProviders from "../../services/providerservices.js";
import AddPerson from "../Modal/AddPerson.vue";

export default {
  components: { AddPerson },
  setup(props){
    const {drinks, getDrinks } = useDrinks();
    const {drinkList, errors } = useInputs();
    const {providers, getProviders, createProvider, } = useProviders();
    const currentProvider = reactive({
        id: '',
        name: '',
        contact: '',
      });
      const storeProvider = async () => {
          await createProvider({...currentProvider});
          await getProviders();
      }
        
    return{
      drinks,
      providers,
      getProviders,
      currentProvider,
      getDrinks,
      drinkList,
      storeProvider,
      errors,
    }
  },
  data () {
    return {
      searchDrink: '',
      searchProvider: '',
      m_error: '',
      show_m_field: false,
      show_a_p: false,
      amount: '', 
      currentDrink:  {
        id: '',
        name: '',
        price: '',
        quantity: ''
      },
    }
  },
  computed: {
    filteredDrink() {
        return this.drinks.filter((drink) => {
            return drink.name.toLowerCase().includes(this.searchDrink.toLowerCase());
        })
    },
    filteredProvider() {
        return this.providers.filter((provider) => {
            return provider.name.toLowerCase().includes(this.searchProvider.toLowerCase());
        })
    },
    sum() {
      this.amount = 0;
      this.drinkList.forEach((item, index, arr) => {
          this.amount += parseFloat(item.price) * parseFloat(item.quantity);
      });
      return this.amount;
    },
  },
  methods: {
    showInput(drink) {
      this.m_error = false;
      if(this.isHere(drink.id)){
        this.m_error = "Cette boisson existe déja dans l'éntrée en cours, vous pouvez la modifier !!!";
      }else{
        if(this.show_m_field)
        {
          this.m_error = "Une modification est en cours, veillez la terminée";
        }else{
        this.currentDrink = drink;
        this.currentDrink.quantity = '';
        }
      }
    },
    showModifyInput(drink) {
        this.show_m_field = true;
    },
    validateModifyInput(drink) {
        if(drink.quantity == '' || drink.quantity == 0){
        this.m_error = 'Entrez une quantité valide';
      }else{
        this.show_m_field = false;
      }
    },
    insertQuantity() {
      if(this.currentDrink.quantity == '' || this.currentDrink.quantity == 0){
        this.m_error = 'Entrez une quantité valide';
      }else{
        // console.log(this.currentDrink);
        if(this.isHere(this.currentDrink.id)){
          this.m_error = "Cette boisson existe déja dans l'éntrée en cours, vous pouvez la modifier !!!";
        }else{
          if(this.show_m_field)
        {
          this.m_error = "Une modification est en cours, veillez la terminée";
        }else{
          this.drinkList.push(this.currentDrink);
        }
        }
      }
      
    },
    removeDrink(drink) {
        let index = this.drinkList.indexOf(drink);
        this.drinkList.splice(index, 1);
    },
    selectProvider(provider) {
        this.currentProvider = provider;
        this.searchProvider = this.currentProvider.name; 
        // console.log(this.currentProvider);
    },
    checkProvider() {
        if(this.currentProvider.id != '' && this.currentProvider.name != this.searchProvider){
            this.currentProvider.id = '';
            this.currentProvider.name = '';
            this.currentProvider.contact = '';
            console.log(this.currentProvider);
        }else{
        console.log(this.currentProvider);
        }
    },
    toogleModal() {
      this.show_a_p = !this.show_a_p;
      this.currentProvider.id = '';
      this.currentProvider.name = this.searchProvider;
    },
    addProvider() {
        this.storeProvider();
        this.show_a_p = !this.show_a_p;
    },
    isHere(id) {
        for (let i = 0; i < this.drinkList.length; i++) {
            if (this.drinkList[i].id == id) {
                return true;
            }
        }
        return false;
    }
  },
  mounted () {
    this.getDrinks();
    this.getProviders();
  }
}
</script>