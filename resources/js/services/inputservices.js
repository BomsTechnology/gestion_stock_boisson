import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"
// import useProviders from "./providerservices.js";
// import useInputs from "./drinkservices.js";

export default function useInputs() {
    const inputs = ref([]);
    // const input = ref([]);
    const drinkList = ref([]);
    const errors = ref('');
    const providers = ref([]);

    // const {drinks, getInputs } = useInputs();

    const getInputs = async () => {
        let response = await axios.get('/api/providers');
        providers.value = response.data.data;
        response = await axios.get('/api/inputs');
        inputs.value = response.data.data;

        for (var i = 0; i < inputs.value.length; i++) {
            for (var y = 0; y < providers.value.length; y++) {
                if(inputs.value[i].provider === providers.value[y].id){
                    inputs.value[i].provider = providers.value[y].name;
                }
            }
          }
    };

    // const getInput = async (id) => {
    //     let response = await axios.get('/api/inputs/' + id);
    //     input.value = response.data.data;
    // };

    const createInputs = async (data) => {
        try {
            await axios.post('/api/inputs', data);
            await getInputs();
            let id = inputs._rawValue[0].id;
            // router.push({ name: 'inputs.details', params: { id : id } });
            // let initialPage = location.pathname;
            location.replace('/inputs/' + id + '/details');
            // window.location('/inputs' + id + '/details');            
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