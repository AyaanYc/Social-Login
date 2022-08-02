import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

export default createStore({
  state() {
    return {
      user: {},
      sallerSelectedProduct: {},
    }
  },
  mutations: {
    setUser: (state, data) => {
      state.user = data;
    },
    sallerSelectedProduct: (state, data) => {
      state.sallerSelectedProduct = data;
    }
  },
  plugins: [
    createPersistedState({
      paths: ['user']
    })
  ],
});