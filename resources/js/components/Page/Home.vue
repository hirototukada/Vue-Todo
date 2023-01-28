<template>
    <h1 class="mt-3 text-center">Todo</h1>
    <div class="w-75 m-auto">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">完了チェック</th>
                    <th scope="col">タスク</th>
                    <th scope="col">メモ</th>
                    <th scope="col">備考</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="defaultCheck1"
                            />
                        </div>
                    </td>
                    <td>解約サイト確認メールパーツ</td>
                    <td>1/24まで</td>
                    <td>
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
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <router-link class="mr-3" to="/todoAdd">
                <button type="button" class="mt-4 btn btn-primary">
                    タスクの追加
                </button>
            </router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
import { useRoute } from "vue-router";
import { ref } from "@vue/runtime-core";

export default {
    setup() {
        const route = useRoute();
    },
    async mounted() {
        //todoデータ格納
        let showTodoList = ref();
        await axios
            .get("/api/todo")
            .then((res) => {
                showTodoList = res;
                console.log(showTodoList);
            })
            .catch();
    },
};
</script>
