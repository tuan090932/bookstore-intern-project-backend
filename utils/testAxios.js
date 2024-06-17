import httpClient from "@/utils/httpClient";
import constant from "@/utils/constant";


export default {
    async getBooks($params) {
        return await httpClient
        .get(constant.API.BOOK + "?" + new URLSearchParams($params))
        .then((response) => {
            return response;
        })
    },
}

