import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    state: {
        series: [
			{
                id: 1,
				key: 0,
				selected: false,
                title: 'Game of Thrones',
                image: 'https://ia.media-imdb.com/images/M/MV5BMjE3NTQ1NDg1Ml5BMl5BanBnXkFtZTgwNzY2NDA0MjI@._V1_UX182_CR0,0,182,268_AL_.jpg',
                selected: false,
            },
            {
                id: 2,
				key: 1,
				selected: false,
                title: 'Better Call Saul',
                image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
            },
            {
                id: 3,
				key: 2,
				selected: false,
                title: 'The Expanse',
                image: 'https://ia.media-imdb.com/images/M/MV5BMTYxNzI0NDY2OF5BMl5BanBnXkFtZTgwNDg0MDQyMTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
            },
            {
                id: 4,
				key: 3,
				selected: false,
                title: 'Breaking Bad',
                image: 'https://ia.media-imdb.com/images/M/MV5BZDNhNzhkNDctOTlmOS00NWNmLWEyODQtNWMxM2UzYmJiNGMyXkEyXkFqcGdeQXVyNTMxMjgxMzA@._V1_UY268_CR4,0,182,268_AL_.jpg',
            },
            {
                id: 5,
				key: 4,
				selected: false,
                title: 'Making a Murderer',
                image: 'https://ia.media-imdb.com/images/M/MV5BNTc4NjI4NjYyNl5BMl5BanBnXkFtZTgwNzk1NTczNzE@._V1_UX182_CR0,0,182,268_AL_.jpg',
            },
            {
                id: 6,
				key: 5,
				selected: false,
                title: 'Fargo',
                image: 'https://ia.media-imdb.com/images/M/MV5BMTg5NTYxNjkyNl5BMl5BanBnXkFtZTgwNzY1Mjg4MTI@._V1_UY268_CR1,0,182,268_AL_.jpg',
            }
        ],
    },
    getters: {
        selectedSeries: state => state.series.filter(series => series.selected === true)
    },
    mutations: {
        receiveSeries: (state, series) => state.series = series,
        toggleSelected: (state, key) => state.series[key].selected = !state.series[key].selected
    },
    actions: {
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
                api.submitSeries({ ids: series.map(series => series.id), email });
            } catch(err) {
                console.debug(err);
            }
        }
    },
});

