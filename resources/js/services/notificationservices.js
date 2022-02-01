import axios from "axios";
import { ref } from "vue";

export default function useNotification() {

    const notifications = ref([]);
    const drinks = ref([]);

    const checkNotification = async () => {
        let response = await axios.get('/api/drinks');
        drinks.value = response.data.data;
        console.log(drinks);
        for (var i = 0; i < drinks.value.length; i++) {

                if(drinks.value[i].quantity <= 5){
                    notifications.value.push(drinks.value[i])
                }

          }

          console.log(notifications.value);
    };

    return{
        checkNotification,
        notifications
    }
}