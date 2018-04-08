import axios from 'axios';

export default {
    submitSeries({ ids, email }) {
        return axios.post('api/someendpoint', {
            series: ids,
            email: email
        });
    },
    getSeries() {
        return axios.get('api/someendpoint');
    }
}