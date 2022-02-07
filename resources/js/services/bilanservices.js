import axios from "axios";
import { ref } from "vue";

export default function useBilan() {
    const loading = ref('');
    const providers = ref([]);
    const customers = ref([]);
    const inputs = ref([]);
    const outputs = ref([]);

    const getBilanPeriod = async (period) => {
        loading.value = '';
        inputs.value = [];
        outputs.value = [];
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        response = await axios.get('/api/providers');
        providers.value = response.data.data;
        response = await axios.get('/api/bilan-inputs-period/' + period);
        inputs.value = response.data.data;
        response = await axios.get('/api/bilan-outputs-period/' + period);
        outputs.value = response.data.data;

        for (var i = 0; i < outputs.value.length; i++) {
                for (var y = 0; y < customers.value.length; y++) {
                    if (outputs.value[i].person === customers.value[y].id) {
                        outputs.value[i].person = customers.value[y].name;
                    }
                }
        }
        
        for (var i = 0; i < inputs.value.length; i++) {
            for (var y = 0; y < providers.value.length; y++) {
                if (inputs.value[i].person === providers.value[y].id) {
                    inputs.value[i].person = providers.value[y].name;
                }
            }
        }
        loading.value = true;
    };

    const getBilanDate = async (dates) => {
        loading.value = '';
        inputs.value = [];
        outputs.value = [];

        console.log(dates);
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        response = await axios.get('/api/providers');
        providers.value = response.data.data;
        response = await axios.get('/api/bilan-inputs-date/' + dates.date1 + '/' + dates.date2);
        inputs.value = response.data.data;
        response = await axios.get('/api/bilan-outputs-date/' + dates.date1 + '/' + dates.date2);
        outputs.value = response.data.data;

        for (var i = 0; i < outputs.value.length; i++) {
            // let d = new Date(moves.value[i].date);
            // moves.value[i].date = moment(d).format('YYYY-MM-DD');
                for (var y = 0; y < customers.value.length; y++) {
                    if (outputs.value[i].person === customers.value[y].id) {
                        outputs.value[i].person = customers.value[y].name;
                    }
                }
        }
        for (var i = 0; i < inputs.value.length; i++) {
            for (var y = 0; y < providers.value.length; y++) {
                if (inputs.value[i].person === providers.value[y].id) {
                    inputs.value[i].person = providers.value[y].name;
                }
            }
        }
        loading.value = true;
    };

    return{
        getBilanPeriod,
        getBilanDate,
        loading,
        inputs,
        outputs
    }
}