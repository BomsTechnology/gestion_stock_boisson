import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"

export default function useProviders() {

    const providers = ref([]);
    const provider = ref([]);
    const errors = ref('');
    const loading = ref('');

    const getProviders = async () => {
        let response = await axios.get('/api/providers');
        providers.value = response.data.data;
        loading.value = true;
    };

    const getProvider = async (id) => {
        let response = await axios.get('/api/providers/' + id);
        provider.value = response.data.data;
    };

    const createProvider = async (data) => {
        try {
            await axios.post('/api/providers', data);
        } catch (e) {
            if (e.response.status == 422) {
                for (const key in e.response.data.errors)
                    errors.value += e.response.data.errors[key][0] + '\n';
            }
        }
    };

    const updateProvider = async (id) => {

        try {
            await axios.put('/api/providers/' + id, provider.value);
            router.push({ name: 'providers' });
        } catch (e) {
            if(e.response.status == 422){
                for(const key in e.response.data.errors)
                errors.value += e.response.data.errors[key][0] + '\t\n';
            }
        }
        
    };

    const destroyProvider = async (id) => {
        try {
        await axios.delete('/api/providers/' + id);
    } catch (e) {
        if (e.response.status == '500') {
            errors.value = 'Impossible de supprimer ce fournisseur il intervient dans une ou plusieurs transactions';
        }
    }
    };

    return {
        providers,
        provider,
        errors,
        loading,
        getProviders,
        getProvider,
        createProvider,
        updateProvider,
        destroyProvider
    };
} 