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
            <td>{{ showTodoList.content }}</td>
            <td>{{ showTodoList.memo }}</td>
            <td>
                {{ format(showTodoList.created_at) }}
            </td>
            <td>
                <p class="link" v-on:click="getEditData(showTodoList.id)">
                    編集
                </p>
            </td>
        </tr>
        <InfiniteLoading @infinite="load">
            <template #complete>
                <span>読み込み終了</span>
            </template>
        </InfiniteLoading>
        <!-- <div class="result" v-for="comment in comments" :key="comment.id">
            <div>{{ comment.email }}</div>
            <div>{{ comment.id }}</div>
        </div>
        <InfiniteLoading @infinite="load" /> -->
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

dayjs.locale("ja");

export default defineComponent({
    components: { InfiniteLoading },
    setup(props, context) {
        const router = useRouter();
        const showTodoLists = ref();
        const error = useErrorStore();

        let comments = ref([]);
        let page = 1;
        const load = async ($state) => {
            console.log($state.loaded());
            // console.log("loading...");
            // try {
            //     const response = await fetch(
            //         "https://jsonplaceholder.typicode.com/comments?_limit=10&_page=" +
            //             page
            //     );
            //     const json = await response.json();
            //     console.log(json);
            //     if (json.length < 10) $state.complete();
            //     else {
            //         comments.value.push(...json);
            //         $state.loaded();
            //     }
            //     page++;
            // } catch (error) {
            //     $state.error();
            // }
        };
        let res = ref();
        // 読み込みのタイミングで取得処理
        onMounted(async () => {
            // 取得処理
            res = getTodoData();
            // プロミスリザルト変換処理
            res.then((result) => {
                // エラーハンドリング
                if (result.res) {
                    showTodoLists.value = result.res.data;
                } else {
                    error.massage = result.error;
                    error.switch();
                }
            });
        });

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
            comments,
            error,
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
