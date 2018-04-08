export default {
    getSeries: async ({ commit }) => {
        try {
            const series = await api.getSeries();
            commit('receiveSeries', series);
        } catch(err) {
            console.debug(err);
        }
    },
    submitSeries: async ({ commit }, { series, email }) => {
        try {
            await api.submitSeries({ ids: series.map(series => series.id), email });
            commit('deselectAllSeries');
        } catch(err) {
            console.debug(err);
        }
    }
}