import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"


export default function useInputs() {
    const inputs = ref([]);
    const drinkList = ref([]);
    const errors = ref('');
    const providers = ref([]);



    const getInputs = async () => {
        let response = await axios.get('/api/providers');
        providers.value = response.data.data;
        response = await axios.get('/api/inputs');
        inputs.value = response.data.data;

        for (var i = 0; i < inputs.value.length; i++) {
            inputs.value[i].date = new Date(inputs.value[i].date);
            for (var y = 0; y < providers.value.length; y++) {
                if(inputs.value[i].person === providers.value[y].id){
                    inputs.value[i].person = providers.value[y].name;
                }
            }
          }
    };



    const createInputs = async (data) => {
        try {
            await axios.post('/api/inputs', data);
            await getInputs();
            let id = inputs._rawValue[0].id;
            location.replace('/inputs/' + id + '/details');           
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
        createInputs,
        getInputs,
        inputs
    }
}