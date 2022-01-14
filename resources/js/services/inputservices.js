import axios from "axios";
import { ref } from "vue";
import router from "../router/index.js"
import useDrinks from "./drinkservices.js";

export default function useInputs() {

    const drinkList = ref([]);
    const errors = ref('');

    const {drinks, getDrinks } = useDrinks();


    return {
        drinkList,
        errors,
    }
}