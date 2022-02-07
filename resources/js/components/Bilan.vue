<template>
    <div class="flex flex-col">
    <div class="relative mb-4 flex justify-between items-center w-full">
      <div class="flex items-center justify-center">
        <div class="shadow-lg py-2 px-4 rounded-md">
        <select class="rounded pr-8 pl-4 border-none focus:ring-0" v-model="period" @change="changePeriod(period)">
            <option v-for="period in periods" :key="period.value"  :value="period.value">{{ period.text }}</option>

        </select>
      </div>
      <div class="ml-4 shadow-lg py-2 px-4 rounded-md">
        Du:
        <input type="date" class="rounded px-8 border-none focus:ring-0" v-model="dates.date1">
        Au:
        <input type="date" class="rounded px-8 border-none focus:ring-0" v-model="dates.date2">
        <button type="button" @click="choiseDate" class="px-3 py-2 ml-2 bg-blue-500 text-white rounded hover:bg-blue-700">Rechercher</button>
      </div> 
      </div>
        
        <!-- <div class="relative flex items-center">
           <span class="absolute mt-px ml-2 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
</svg></span>
          <input type="search" name="search" v-model="searchKey" placeholder="Recherche"
              class="rounded pl-8 placeholder-gray-700 border-gray-500">
              <span @click="toogleNotif"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 cursor-pointer" :class="{'h-4 w-4 animate-ping text-orange-500': notifications.length != []}" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg></span>
            <Notification :open="show_notif" :notifications="notifications" />
        </div> -->
    </div>
    <div class="py-6 px-4 text-2xl font-semibold">
        Bilan 
         <span v-if="dates.date1 != '' && dates.date2 != ''">Du: {{ dates.date1 }} Au: {{ dates.date2 }} </span>
        <span v-else-if="period == 'Aujourd\'hui'">D'{{ period }}</span>
        <span v-else>De {{ period }}</span>
    </div>
    <div class="py-2">
        <span v-if="error != ''" class="text-red-500">{{ error }}</span>
    </div>
    <div class="md:flex block justify-center w-full">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 w-full">     
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <caption class="py-2 text-xl font-light">ENTREES</caption>
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom 
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Type
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Montant
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <span class="sr-only">Action</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" v-if="inputs.length != 0">            
            <tr v-for="move in inputs" :key="move.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        {{ move.person }}
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.type }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.date }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ move.amount }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a :href="'inputs/' + move.id + '/details'" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </a >
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                    <div class="text-sm font-bold text-gray-900 text-center">
                        MONTANT TOTAL
                    </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800">
                    {{ sumInput }} FCFA
                </span>
              </td>
            </tr>

          </tbody>
          <tr v-else-if="loading != true">
            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-center"
                colspan="5">
                <span class="text-center ">
                    <svg class="animate-spin w-10 h-10 text-blue-500 inline-block"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335">
                        <path fill="#008DD2"
                            d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                    </svg>
                    <span class="ml-2 text-lg font-semibold text-black">
                        Chargement
                    </span>
                </span>
            </td>
        </tr>
        <tr v-else>
          <td class="px-6 py-4 whitespace-nowrap text-center" colspan="5">
            AUCUN RESULTAT
          </td>
        </tr>
          
        </table>
      </div>
    </div>
  </div>
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 w-full ">    
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <caption class="py-2 text-xl font-light">SORTIES</caption>
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom 
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Type
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Montant
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <span class="sr-only">Action</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200" v-if="outputs.length != 0">            
            <tr v-for="move in outputs" :key="move.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        {{ move.person }}
                    </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.type }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                    {{ move.date }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ move.amount }} FCFA
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a :href="'outputs/' + move.id + '/details'" class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700"> Détails </a >
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                    <div class="text-sm font-bold text-gray-900 text-center">
                        MONTANT TOTAL
                    </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800">
                    {{ sumOutput }} FCFA
                </span>
              </td>
            </tr>

          </tbody>
          <tr v-else-if="loading != true">
            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-center"
                colspan="5">
                <span class="text-center ">
                    <svg class="animate-spin w-10 h-10 text-blue-500 inline-block"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335">
                        <path fill="#008DD2"
                            d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                    </svg>
                    <span class="ml-2 text-lg font-semibold text-black">
                        Chargement
                    </span>
                </span>
            </td>
        </tr>
        <tr v-else>
          <td class="px-6 py-4 whitespace-nowrap text-center" colspan="5">
            AUCUN RESULTAT
          </td>
        </tr>
          
        </table>
      </div>
    </div>
  </div>
  </div>
    </div>
</template>

<script>
import useNotification from "../services/notificationservices.js";
import useBilan from "../services/bilanservices.js";
import Notification from "./Modal/Notification.vue";

export default {
  components: {  Notification },
  data() {
    return{
      searchKey: '',
      error: '',
      show_notif: false,
      amountOutput: '',
      amountInput: '',
      period: 'Aujourd\'hui',
      dates: {
        "date1": '',
        "date2": '',
    },
      periods: [
          {text: 'Aujourd\'hui', value: 'Aujourd\'hui'},
          {text: 'Cette Semaine', value: 'Cette Semaine'},
          {text: 'Ce mois', value: 'Ce mois'},
          {text: 'Cette année', value: 'Cette année'},
      ]
    }
  },
  setup(props) {

    const {getBilanPeriod, getBilanDate, inputs, outputs, loading} = useBilan();
    const { checkNotification, notifications} = useNotification();

    return {
      getBilanPeriod,
      checkNotification,
      getBilanDate,
      notifications,
      inputs,
      outputs,
      loading,
    };

  },
  computed: {
  sumInput() {
      this.amountInput = 0;
      this.inputs.forEach((item, index, arr) => {
          this.amountInput += parseFloat(item.amount);
      });
      return this.amountInput;
    },
  sumOutput() {
      this.amountOutput = 0;
      this.outputs.forEach((item, index, arr) => {
          this.amountOutput += parseFloat(item.amount);
      });
      return this.amountOutput;
    },
  },
  mounted() {
    this.checkNotification();
    this.getBilanPeriod(this.period);
  },
  methods: {
    toogleNotif() {
        this.show_notif = !this.show_notif;
      },
    changePeriod(period){
        this.getBilanPeriod(period);
    },
    choiseDate(){
        if(this.dates.date1 == '' || this.dates.date2 == ''){
            this.error = 'Veillez renseigner les 02 dates !!!'
        }else{
        this.getBilanDate(this.dates);
        }
    }
  }
  
}
</script>