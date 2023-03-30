import Vuex from "vuex";

export default new Vuex.Store({
    state: {
        idToken: null,
    },
    getters: {
        idToken: (state) => state.idToken,
    },
    mutations: {
        updateIdToken(state, idToken) {
            state.idToken = idToken;
        },
    },
});
