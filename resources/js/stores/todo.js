import { defineStore } from "pinia";

export const useTodoStore = defineStore("todo", {
    state: () => ({
        task: "",
        content: "",
        memo: "",
        show: false,
    }),
    actions: {
        switch(showTodoList) {
            if (this.show == true) {
                this.show = false;
                this.task = "";
                this.content = "";
                this.memo = "";
            } else {
                this.show = true;
                this.task = showTodoList.task;
                this.content = showTodoList.content;
                this.memo = showTodoList.memo;
            }
        },
    },
});
