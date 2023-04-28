<template>
    <transition name="fade">
        <Content v-if="todo.show"></Content>
    </transition>
    <transition name="fade">
        <Modal v-if="error.show"></Modal>
    </transition>
    <div class="mt-3 mb-5">
        <div class="card border-success m-auto w-75">
            <div class="card-header"><h1 class="text-center">Todo</h1></div>
            <div class="card-body text-success">
                <div class="form-group">
                    <h5 class="card-title">検索</h5>
                    <input
                        type="text"
                        class="form-control col-12"
                        placeholder="フリー検索"
                    />
                </div>
                <div class="form-group d-flex">
                    <input
                        type="text"
                        class="form-control col-md-5 mr-4"
                        placeholder="タスク"
                    />
                    <input
                        type="text"
                        class="form-control col-md-5"
                        placeholder="詳細"
                    />
                </div>
                <div class="form-group d-flex">
                    <input
                        type="text"
                        class="form-control col-md-5 mr-4"
                        placeholder="メモ"
                    />
                    <input
                        type="date"
                        v-model="startData"
                        :min="mindata"
                        onkeydown="return false"
                    />
                    <p>　～　</p>
                    <input
                        type="date"
                        v-model="endData"
                        :min="mindata"
                        onkeydown="return false"
                    />
                </div>
                <div class="text-right">
                    <button
                        class="btn btn-outline-success"
                        type="button"
                        id="button-addon2"
                    >
                        <i class="fas fa-search"></i> 検索
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="m-auto tableAll mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">タスク</th>
                    <th scope="col">登録日</th>
                    <th scope="col">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-pencil-square"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                            />
                            <path
                                fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                            />
                        </svg>
                        詳細
                    </th>
                    <th scope="col">編集</th>
                </tr>
            </thead>
            <Todo_list></Todo_list>
        </table>
        <div class="text-right">
            <router-link class="mr-3 upper" to="/todoAdd">
                <button type="button" class="mt-4 btn btn-primary">
                    タスクの追加
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import Todo_list from "./Todo/Todo_list.vue";
import Content from "../Modal/Content.vue";
import Modal from "../Modal/Modal.vue";
import { useTodoStore } from "../../stores/todo";
import { useErrorStore } from "../../stores/error";
import { useUserStore } from "../../stores/user";

export default {
    components: {
        Todo_list,
        Content,
        Modal,
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const todo = useTodoStore();
        const error = useErrorStore();

        let mindata = ref();
        let year = new Date().getFullYear() - 5;
        let now = new Date().toISOString().split("T")[0];

        mindata = year + "-" + now.split("-")[1] + "-" + now.split("-")[2];

        console.log(now.split("-"));
        console.log(mindata);

        return { todo, error, mindata };
    },
};
</script>
<style>
.tableAll {
    width: 85%;
}
.link {
    color: #007bff;
    cursor: pointer;
}
.upper {
    position: fixed;
    right: 50px;
    bottom: 50px;
    transition: 1s;
    opacity: 0.7;
}
.upper:hover {
    opacity: 1;
}
</style>
