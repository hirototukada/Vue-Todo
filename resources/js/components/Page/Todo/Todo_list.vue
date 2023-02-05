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
    </tbody>
</template>

<script>
import { defineComponent, reactive, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";
import dayjs from "dayjs";
dayjs.locale("ja");

export default defineComponent({
    setup(props, context) {
        const router = useRouter();
        const showTodoLists = ref();
        // 読み込みのタイミングで取得処理
        onMounted(async () => {
            await axios
                .get("/api/todo")
                .then((res) => {
                    console.log(res.data.length);
                    showTodoLists.value = res.data;
                })
                .catch((err) => {
                    let errorText = "";
                    switch (err.response.status) {
                        case 422:
                            errorText = err.response.data.message;
                            break;

                        default:
                            errorText =
                                "サーバーエラーです。時間をおいてアクセスしてください。";
                            break;
                    }
                    return openModal(errorText);
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
                    let errorText = "";
                    switch (err.response.status) {
                        case 422:
                            errorText = err.response.data.message;
                            break;

                        default:
                            errorText =
                                "サーバーエラーです。時間をおいてアクセスしてください。";
                            break;
                    }
                    return openModal(errorText);
                });
        };
        // エラーを受け取る用
        let openModal = (errorMsg) => {
            context.emit("open", errorMsg);
        };

        return {
            showTodoLists,
            getEditData,
            openModal,
            format,
        };
    },
});
</script>
