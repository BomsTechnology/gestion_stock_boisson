import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js";

export default function useCustomers() {

    const customers = ref([]);
    const customer = ref([]);
    const loading = ref('');
    const errors = ref('');

    const getCustomers = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
        loading.value = true;
    };

    const getCustomer = async (id) => {
        let response = await axios.get('/api/customers/' + id);
        customer.value = response.data.data;
    };

    const createCustomer = async (data) => {
        try {
            await axios.post('/api/customers', data);
        } catch (e) {
            if (e.response.status == 422) {
                for (const key in e.response.data.errors)
                    errors.value += e.response.data.errors[key][0] + "\n";
            }
        }
    };

    const updateCustomer = async (id) => {

        try {
            await axios.put('/api/customers/' + id, customer.value);
            router.push({ name: 'customers' });
        } catch (e) {
            if(e.response.status == 422){
                for(const key in e.response.data.errors)
                errors.value += e.response.data.errors[key][0] + '\t\n';
            }
        }
        
    };

    const destroyCustomer = async (id) => {
        try {
        await axios.delete('/api/customers/' + id);
    } catch (e) {
        if (e.response.status == '500') {
            errors.value = 'Impossible de supprimer ce client il intervient dans une ou plusieurs transactions';
        }
    }
    };

    return {
        customers,
        customer,
        errors,
        getCustomers,
        getCustomer,
        createCustomer,
        updateCustomer,
        destroyCustomer
    };
} 