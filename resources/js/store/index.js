import Vuex from "vuex";

use(Vuex);

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
