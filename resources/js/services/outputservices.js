import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"
// import useCustomers from "./customerservices.js";
// import useOutputs from "./drinkservices.js";

export default function useOutputs() {
    const outputs = ref([]);
    // const output = ref([]);
    const drinkList = ref([]);
    const errors = ref('');
    const customers = ref([]);

    // const {drinks, getOutputs } = useOutputs();

    const getOutputs = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        response = await axios.get('/api/outputs');
        outputs.value = response.data.data;

        for (var i = 0; i < outputs.value.length; i++) {
            for (var y = 0; y < customers.value.length; y++) {
                if(outputs.value[i].customer === customers.value[y].id){
                    outputs.value[i].customer = customers.value[y].name;
                }
            }
          }
    };

    // const getOutput = async (id) => {
    //     let response = await axios.get('/api/outputs/' + id);
    //     output.value = response.data.data;
    // };

    const createOutputs = async (data) => {
        try {
            await axios.post('/api/outputs', data);
            await getOutputs();
            let id = outputs._rawValue[0].id;
            // router.push({ name: 'outputs.details', params: { id : id } });
            // let initialPage = location.pathname;
            location.replace('/outputs/' + id + '/details');
            // window.location('/outputs' + id + '/details');            
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
        outputs
    }
}