import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  namespaced: true,
  state: {
    series: [
      {
        id: 1,
        title: 'Game of Thrones',
        image: 'https://ia.media-imdb.com/images/M/MV5BMjE3NTQ1NDg1Ml5BMl5BanBnXkFtZTgwNzY2NDA0MjI@._V1_UX182_CR0,0,182,268_AL_.jpg',
        selected: false,
      },
      {
        id: 2,
        title: 'Better Call Saul',
        image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
      },
      {
        id: 3,
        title: 'Better Call Saul',
        image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
      },
      {
        id: 4,
        title: 'Better Call Saul',
        image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
      },
      {
        id: 5,
        title: 'Better Call Saul',
        image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
      },
      {
        id: 6,
        title: 'Better Call Saul',
        image: 'https://ia.media-imdb.com/images/M/MV5BODY2ODU0MTY5Nl5BMl5BanBnXkFtZTgwNjQ0OTc2MTI@._V1_UX182_CR0,0,182,268_AL_.jpg',
      },
    ],
  },
  getters: {},
  mutations: {},
  actions: {},
});

