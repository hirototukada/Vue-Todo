<template>
    <tbody>
        <tr v-for="showTodoList in showTodoLists" :key="showTodoList.id">
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
            <td>{{ showTodoList.task }}</td>
            <td>
                {{ format(showTodoList.created_at) }}
            </td>
            <td class="link" @click="todo.switch(showTodoList)">
                詳細はクリック
            </td>
            <td>
                <p class="link" v-on:click="getEditData(showTodoList.id)">
                    編集
                </p>
            </td>
        </tr>
        <InfiniteLoading @infinite="load"> </InfiniteLoading>
    </tbody>
</template>

<script>
import { defineComponent, reactive, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";
import dayjs from "dayjs";
import { getTodoData } from "./Model/common";
import { useErrorStore } from "../../../stores/error";
import { useTodoStore } from "../../../stores/todo";
import { useUserStore } from "../../../stores/user";

dayjs.locale("ja");

export default defineComponent({
    components: { InfiniteLoading },
    setup(props, context) {
        const router = useRouter();
        const showTodoLists = ref([]);
        const error = useErrorStore();
        const todo = useTodoStore();
        const user = useUserStore();

        const route = useRoute();
        const userEmail = route.query.email;

        let count = ref(10);
        let page = 1;
        const load = async ($state) => {
            // 取得処理
            res = getTodoData(page, user.id, userEmail);
            // プロミスリザルト変換処理
            res.then((result) => {
                // エラーハンドリング
                if (result.res) {
                    count.value = result.res.data;
                    showTodoLists.value.push(...result.res.data);
                    console.log(showTodoLists);
                } else {
                    error.massage = result.error;
                    error.switch();
                }
            });
            if (count.value.length < 10) {
                $state.complete();
            } else {
                $state.loaded();
            }
            page++;
        };
        let res = ref();

        const format = (date) => {
            let created_at = dayjs(date).format("YYYY年MM月DD日");
            return created_at;
        };
        // 渡す用
        const getEditData = async (id) => {
            await axios
                .get("/api/editSearch/" + id)
                .then((res) => {
                    return router.push({
                        name: "Todo_edit",
                        query: res.data,
                    });
                })
                .catch((err) => {
                    switch (err.response.status) {
                        case 422:
                            error.massage = err.response.data.message;
                            break;

                        default:
                            error.massage =
                                "サーバーエラーです。時間をおいてアクセスしてください。";
                            break;
                    }
                    error.switch();
                });
        };

        return {
            showTodoLists,
            getEditData,
            format,
            load,
            error,
            todo,
        };
    },
});
</script>

<style>
.result {
    display: flex;
    flex-direction: column;
    gap: 5px;
    font-weight: 300;
    width: 400px;
    padding: 10px;
    text-align: center;
    margin: 0 auto 10px auto;
    background: #eceef0;
    border-radius: 10px;
}
</style>
