import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"

export default function useDrinks() {

    const drinks = ref([]);
    const drink = ref([]);
    const errors = ref('');

    const getDrinks = async () => {
        let response = await axios.get('/api/drinks');
        drinks.value = response.data.data;
    };

    const getDrink = async (id) => {
        let response = await axios.get('/api/drinks/' + id);
        drink.value = response.data.data;
    };

    const createDrink = async (data) => {
        try {
            await axios.post('/api/drinks', data);
            router.push({ name: 'drinks' });
        } catch (e) {
            if (e.response.status == 422) {
                for (const key in e.response.data.errors)
                    errors.value += e.response.data.errors[key][0] + "\n";
            }
        }
    };

    const updateDrink = async (id) => {

        try {
            await axios.put('/api/drinks/' + id, drink.value);
            router.push({ name: 'drinks' });
        } catch (e) {
            if(e.response.status == 422){
                for(const key in e.response.data.errors)
                errors.value += e.response.data.errors[key][0] + '\t\n';
            }
        }
        
    };

    const destroyDrink = async (id) => {
        await axios.delete('/api/drinks/' + id);
    };

    return {
        drinks,
        drink,
        errors,
        getDrinks,
        getDrink,
        createDrink,
        updateDrink,
        destroyDrink
    };
} 