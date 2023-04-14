<template>
    <div
        class="modal-background"
        v-if="todo.show == true"
        @click="todo.switch()"
    ></div>
    <div class="modal-dialog" v-if="todo.show == true">
        <div class="modal-content">
            <div class="modal-header-todo">
                <h6 class="modal-title text-light">
                    {{ todo.task }}
                </h6>
            </div>
            <div class="modal-content-text-todo">{{ todo.content }}</div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import { useTodoStore } from "../../stores/todo";

export default defineComponent({
    setup(props, context) {
        // piniaでエラー共通生成
        const todo = useTodoStore();

        return {
            todo,
        };
    },
});
</script>

<style>
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
    pointer-events: auto;
}

.modal-dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 101;
    pointer-events: none;
    height: 20%;
}

.modal-content {
    height: 100%;
}

.modal-content-text-todo {
    align-items: center;
    margin: auto;
    padding: 15px;
    color: rgb(80, 221, 94);
}

.modal-header-todo {
    background-color: rgb(131, 227, 57);
}
</style>
