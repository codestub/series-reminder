import xhr from '@/utils/xhr';

export default {
    submitSelection({ ids, email }) {
        return xhr.post('api/someendpoint', {
            series: ids,
            email: email
        });
    },
    getSeries() {
        return xhr.get('api/series');
    }
}