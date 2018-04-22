import api from '@/services/api';

export default {
    getSeries: async ({ commit }) => {
        try {
            const response = await api.getSeries();
            commit('receiveSeries', response.data.map((item, index) => ({
                id: item.id,
                key: index,
                selected: false,
                title: item.title,
                image: item.image
            })));
        } catch(err) {
            console.debug(err);
        }
    },
    submitSelection: async ({ commit, getters }, email) => {
        try {
            await api.submitSelection({ ids: getters.selectedSeries.map(series => series.id), email });
            commit('deselectAllSeries');
        } catch(err) {
            console.debug(err);
        }
    }
}