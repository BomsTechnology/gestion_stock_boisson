<template>
<Loading :open="show_loading" />
<AddPerson :open="show_a_p" :toogleModal="toogleModal" :addType="'Client'" :person="currentCustomer" :add="addCustomer" />
  <div class="font-light text-red-500 text-sm p-2 bg-red-100" v-if="m_error != ''">
    <span>{{ m_error }}</span>
  </div>
  <div class="font-light text-red-500 text-sm p-2 bg-red-100" v-if="errors != ''">
    <span>{{ errors }}</span>
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
                Quantité en stock
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
                <div class="text-sm  text-gray-900 uppercase font-semibold">
                    {{ drink.name }}
                </div>
                </div>
            </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ drink.quantity }} Cassier<span v-if="drink.quantity > 1">s</span></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ drink.price }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap" v-if="currentDrink.id != ''">
                <div class="mt-2 flex rounded-md shadow-sm" v-if="currentDrink.id === drink.id">
                  <input v-model="nb" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300">
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button type="button" @click="insertQuantity(drink)" v-if="currentDrink.id == drink.id" class="px-2 py-1 ml-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">  Valider </button>
                <button type="button" @click="showOutput(drink)" v-else class="px-2 py-1 ml-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Ajouter</button>
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
        Informations sur la sortie
      </h1>
      </div>
      <form @submit.prevent="addOutput">
      <div class="mt-2 relative">
        <label for="first-name" class="block text-sm font-light text-gray-700">Nom du fournisseur</label>
        <input type="text" v-model="searchCustomer"   name="customer_id" id="customer_id"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <div class="bg-gray-50 border border-gray-100 shadow-md rounded-md w-full absolute" v-if="searchCustomer != '' && searchCustomer != currentCustomer.name" >
          <ul v-for="customer in filteredCustomer" :key="customer.id">
              <li @click="selectCustomer(customer)" class="p-2 border-b border-gray-300 text-sm cursor-pointer text-gray-500 hover:bg-gray-200 hover:text-gray-600">
                  {{ customer.name }}
              </li>
          </ul>
      </div>
      <!-- <div  class="hidden">
          
      </div> -->
      <div class="bg-gray-50 border border-gray-100 shadow-md rounded-md w-full absolute" v-if="searchCustomer  != '' && filteredCustomer.length == [] ">
          <ul>
              <li class="p-2 border-b border-gray-300 text-sm cursor-pointer text-gray-500 hover:bg-gray-200 hover:text-gray-600" @click="toogleModal">
                  Ajouter le fournisseur "{{ searchCustomer }}"
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
                          <input v-model="drink.buyQte" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded sm:text-sm border-gray-300">
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap" v-else>
                        <div class="text-sm text-gray-900">{{ drink.buyQte }} Cassier<span v-if="drink.quantity > 1">s</span></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          {{ parseFloat(drink.buyQte) * parseFloat(drink.price) }} FCFA
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button type="button" @click="validateModifyOutput(drink)" class="text-indigo-600 hover:text-indigo-900" v-if="show_m_field">Valider</button>
                        <button type="button" @click="showModifyOutput(drink)" class="text-indigo-600 hover:text-indigo-900" v-else>Modifier</button>
                        <button type="button" @click="removeDrink(drink)" class="text-red-600 ml-1 hover:text-red-900">Retier</button>
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
                  <input v-model="sum" readonly type="number" name="amount" id="amount" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="px-3 py-2 text-center w-full bg-blue-500 text-white rounded-md">Enregistrer</button>
      </div>
  </div>
  </form>
    </div>
  </div>

</template>

<script>
import { reactive } from 'vue';
import useDrinks from "../../services/drinkservices.js";
import useOutputs from "../../services/outputservices.js";
import useCustomers from "../../services/customerservices.js";
import AddPerson from "../Modal/AddPerson.vue";
import Loading from "../Modal/Loading.vue";

export default {
  components: { AddPerson, Loading },
  setup(){
    const {drinks, getDrinks } = useDrinks();
    const { errors, createOutputs, drinkList } = useOutputs();
    const {customers, getCustomers, createCustomer, } = useCustomers();
    const currentCustomer = reactive({
        id: '',
        name: '',
        contact: '',
      });
      const currentOutput = reactive({
        amount: '',
        customer_id: '',
        drinks: drinkList
      });
      
      const storeCustomer = async () => {
          await createCustomer({...currentCustomer});
          await getCustomers();
      }

      const saveOutput = async () => {
        currentOutput.drinks = drinkList;
        // console.log(currentCustomer.drinks);
        await createOutputs({...currentOutput});
      };
        
    return{
      drinks,
      customers,
      getCustomers,
      currentCustomer,
      getDrinks,
      drinkList,
      storeCustomer,
      errors,
      saveOutput,
      currentOutput
    }
  },
  data () {
    return {
      searchDrink: '',
      searchCustomer: '',
      m_error: '',
      show_m_field: false,
      show_a_p: false,
      amount: '', 
      currentDrink:  {
        id: '',
        name: '',
        price: '',
        quantity: '',
        buyQte: '',
      },
      nb: '',
      show_loading: false,
    }
  },
  computed: {
    filteredDrink() {
        return this.drinks.filter((drink) => {
            return drink.name.toLowerCase().includes(this.searchDrink.toLowerCase());
        })
    },
    filteredCustomer() {
        return this.customers.filter((customer) => {
            return customer.name.toLowerCase().includes(this.searchCustomer.toLowerCase());
        })
    },
    sum() {
      this.amount = 0;
      this.drinkList.forEach((item, index, arr) => {
          this.amount += parseFloat(item.price) * parseFloat(item.buyQte);
      });
      this.currentOutput.amount = this.amount;
      // console.log(this.currentOutput.amount);
      return this.amount;
    },
  },
  methods: {
    addOutput(){
      this.errors = '';
      if(this.drinkList.length != [] && this.currentCustomer.id != ''){
        this.show_loading = true;    
      }
      this.saveOutput();
    },
    showOutput(drink) {
      this.m_error = false;
      if(this.isHere(drink.id)){
        this.m_error = "Cette boisson existe déja dans l'éntrée en cours, vous pouvez la modifier !!!";
      }else{
        if(this.show_m_field)
        {
          this.m_error = "Une modification est en cours, veillez la terminée";
        }else{
          this.currentDrink = drink;
        }
      }
    },
    showModifyOutput(drink) {
        this.show_m_field = true;
    },
    validateModifyOutput(drink) {
        if(drink.buyQte == '' || drink.buyQte <= 0){
        this.m_error = 'Entrez une quantité valide';
      }else if(drink.quantity < drink.buyQte){
        this.m_error = 'Quantité insuffisante';
      }
      else{
        this.show_m_field = false;
      }
    },
    insertQuantity(drink) {
      if(this.nb == '' || this.nb <= 0){
        this.m_error = 'Entrez une quantité valide';
      }else{

        if(this.isHere(this.currentDrink.id)){
          this.m_error = "Cette boisson existe déja dans l'éntrée en cours, vous pouvez la modifier !!!";
        }else if(this.show_m_field){
          this.m_error = "Une modification est en cours, veillez la terminée";
        }else if(this.nb > drink.quantity){
            this.m_error = "Quantité insuffisante";
        }else{
          this.currentDrink.buyQte = this.nb;
          console.log(this.currentDrink);
          this.drinkList.push(this.currentDrink);
          this.nb = '';
        }
        
      }
      
    },
    removeDrink(drink) {
      if(this.show_m_field)
        {
          this.m_error = "Une modification est en cours, veillez la terminée";
        }else{    
        let index = this.drinkList.indexOf(drink);
        this.drinkList.splice(index, 1);
        }
    },
    selectCustomer(customer) {
        this.currentCustomer = customer;
        this.searchCustomer = this.currentCustomer.name; 
        this.currentOutput.customer_id = this.currentCustomer.id;
    },
    toogleModal() {
      this.show_a_p = !this.show_a_p;
      this.currentCustomer.id = '';
      this.currentCustomer.name = this.searchCustomer;
    },
    addCustomer() {
        this.storeCustomer();
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
    this.getCustomers();
  }
}
</script>