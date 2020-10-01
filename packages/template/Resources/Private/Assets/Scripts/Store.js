import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    isNavOpen: false,
  },
  mutations: {
    openMenu(state) {
      state.isNavOpen = true;
    },
    closeMenu(state) {
      state.isNavOpen = false;
    },
    toggleMenu(state) {
      state.isNavOpen = !state.isNavOpen;
    },
  },
  getters: {
    isNavOpen: state => {
      return state.isNavOpen;
    },
  },
});

export default store;
