import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"


export default function useOutputs() {
    const outputs = ref([]);
    const loading = ref('');
    const drinkList = ref([]);
    const errors = ref('');
    const customers = ref([]);



    const getOutputs = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        response = await axios.get('/api/outputs');
        outputs.value = response.data.data;

        for (var i = 0; i < outputs.value.length; i++) {
            
            outputs.value[i].date = new Date(outputs.value[i].date);

            for (var y = 0; y < customers.value.length; y++) {
                if(outputs.value[i].person === customers.value[y].id){
                    outputs.value[i].person = customers.value[y].name;
                }
            }
          }
          loading.value = true;
    };

    const createOutputs = async (data) => {
        try {
            await axios.post('/api/outputs', data);
            await getOutputs();
            let id = outputs._rawValue[0].id;
            location.replace('/outputs/' + id + '/details');          
        } catch (e) {
            if (e.response.status == 422) {
                for (const key in e.response.data.errors)
                    errors.value += e.response.data.errors[key][0] + "\n";
            }
        }
    };


    return {
        drinkList,
        errors,
        createOutputs,
        getOutputs,
        outputs,
        loading
    }
}