// stores/counter.js
import { defineStore } from "pinia";

export const useErrorStore = defineStore("error", {
    state: () => ({
        show: false,
        massage: "",
    }),
    actions: {
        switch() {
            if (this.show == true) {
                this.show = false;
            } else {
                this.show = true;
            }
        },
    },
});
