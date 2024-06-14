import Axios from "axios";
import { notify } from "@kyvg/vue3-notification";
import constant from "@/utils/constant";
import authService from "@/services/auth.Service";
import { encode, decode } from "js-base64";

const getTokens = function () {
    return localStorage.getItem(constant.LOCAL_STORAGE.ACCESS_TOKENS) ? JSON.parse(decode(localStorage.getItem(constant.LOCAL_STORAGE_KEY.ACCESS_TOKENS))) : "";
}
const httpClient = Axios.create( {
    baseURL: process.env.VUE_APP_API_URL,
    headers: {
        'Content-Type': 'application/json',
    },
    timeout: 10000
});

httpClient.interceptors.request.use(async (config) => {
    const token = getTokens();
    if (token) {
        config.headers['Authorization'] = '${token}';
    }
    return config;
}, async (error) => {
    return Promise.reject(error);
});

export default httpClient;
