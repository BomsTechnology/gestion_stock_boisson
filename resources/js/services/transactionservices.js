import axios from "axios";
import { ref } from "vue";

export default function useDashboard() {

    const moves = ref([]);
    const providers = ref([]);
    const customers = ref([]);
    const loading = ref('');

    const getRecents = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        response = await axios.get('/api/providers');
        providers.value = response.data.data;
        let response1 = await axios.get('/api/inputs-limit');
        let response2 = await axios.get('/api/outputs-limit');
        moves.value = response1.data.data.concat(response2.data.data);

        for (var i = 0; i < moves.value.length; i++) {
            for (var j = 0; j < (moves.value.length - i - 1); j++) {
                if ((new Date(moves.value[j].date)) < (new Date(moves.value[j + 1].date))) {
                    var tmp = moves.value[j];
                    moves.value[j] = moves.value[j + 1];
                    moves.value[j + 1] = tmp;

                }
            }
        }

        for (var i = 0; i < moves.value.length; i++) {
            // moves.value[i].date = new Date(moves.value[i].date);
            if (moves.value[i].type == 'Sorties') {

                for (var y = 0; y < customers.value.length; y++) {
                    if (moves.value[i].person === customers.value[y].id) {
                        moves.value[i].person = customers.value[y].name;
                    }
                }

            }else{

                for (var y = 0; y < providers.value.length; y++) {
                    if (moves.value[i].person === providers.value[y].id) {
                        moves.value[i].person = providers.value[y].name;
                    }
                }

            }
        }
        loading.value = true;
    };

    const getTransactionCustomer = async (id) => {
        let response = await axios.get('/api/transaction-outputs/' +  id);
        moves.value = response.data.data;
        console.log(moves.value);
        response = await axios.get('/api/customers');
        customers.value = response.data.data;
        for (var i = 0; i < moves.value.length; i++) {
            moves.value[i].date = new Date(moves.value[i].date);

                for (var y = 0; y < customers.value.length; y++) {
                    if (moves.value[i].person === customers.value[y].id) {
                        moves.value[i].person = customers.value[y].name;
                    }
                }
        }
        loading.value = true;
    };

    const getTransactionProvider = async (id) => {
        let response = await axios.get('/api/transaction-inputs/' +  id);
        moves.value = response.data.data;
        console.log(moves.value);
        response = await axios.get('/api/providers');
        providers.value = response.data.data;
        for (var i = 0; i < moves.value.length; i++) {
            moves.value[i].date = new Date(moves.value[i].date);

                for (var y = 0; y < providers.value.length; y++) {
                    if (moves.value[i].person === providers.value[y].id) {
                        moves.value[i].person = providers.value[y].name;
                    }
                }
        }
        loading.value = true;
    }

    return {
        getRecents,
        getTransactionCustomer,
        getTransactionProvider,
        moves,
        loading
    };
}