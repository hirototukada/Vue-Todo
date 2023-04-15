<template>
    <div
        class="modal-background-content"
        v-if="todo.show == true"
        @click="todo.switch()"
    ></div>
    <div class="modal-dialog-content" v-if="todo.show == true">
        <div class="modal-content">
            <div class="card" style="width: 24rem">
                <div class="card-header">
                    <h5 class="card-title">{{ todo.task }}</h5>
                </div>
                <div class="card-body">
                    <p>・詳細</p>
                    <p class="card-text">　　{{ todo.content }}</p>
                </div>
                <div class="card-body">
                    <p>・メモ</p>
                    <p class="card-text">　　{{ todo.memo }}</p>
                </div>
            </div>
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
.modal-background-content {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
    pointer-events: auto;
}

.modal-dialog-content {
    position: fixed;
    top: 40%;
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
