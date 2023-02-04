<template>
    <transition name="fade">
        <Modal
            v-if="showContent"
            :errorMsg="errorMsg"
            v-on:close="closeModal()"
        ></Modal>
    </transition>
    <h1 class="mt-3 text-center">Todo編集</h1>
    <div class="w-75 m-auto">
        <form>
            <!-- <input type="hidden" id="task" v-model="id" :v-value="todoId" /> -->
            <!-- タスク -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">
                    タスク：
                </label>
                <p class="text-danger">{{ errors.task }}</p>
                <input
                    type="text"
                    class="form-control"
                    id="task"
                    v-model="task"
                    aria-describedby="taskHelp"
                    @blur="handleTask"
                />
            </div>
            <!-- タスク -->
            <!-- 詳細 -->
            <div class="mb-3 text-end">
                <label for="exampleInputPassword1" class="form-label">
                    詳細：
                </label>
                <p class="text-danger">{{ errors.content }}</p>
                <div class="form-floating">
                    <textarea
                        class="form-control"
                        v-model="content"
                        id="content"
                        style="height: 100px"
                        @blur="handleContent"
                    ></textarea>
                </div>
            </div>
            <!-- 詳細 -->
            <!-- メモ -->
            <div class="mb-3 text-end">
                <label for="exampleInputPassword1" class="form-label">
                    メモ：
                </label>
                <p class="text-danger">{{ errors.memo }}</p>
                <div class="form-floating">
                    <textarea
                        class="form-control"
                        v-model="memo"
                        placeholder="備考"
                        id="floatingTextarea"
                        style="height: 100px"
                        @blur="handleMemo"
                    ></textarea>
                </div>
            </div>
            <!-- メモ -->
            <div class="d-flex">
                <!-- 削除ボタン -->
                <Delete :todoId="todoId" />
                <!-- 更新ボタン -->
                <div class="text-right">
                    <button
                        :disabled="!meta.valid"
                        type="button"
                        class="btn btn-primary text-end"
                        @click="onSubmit"
                    >
                        更新する
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
// バリデーション用プラグイン
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
import { useRoute, useRouter } from "vue-router";
import Modal from "../../Modal/Modal.vue";
import { ref, onMounted, onBeforeMount } from "vue";
import deleteData from "./Todo_model.vue";
import Delete from "./Model/Delete.vue";

// テンプレート表示
export default {
    components: {
        Modal,
        Delete,
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const todoId = ref(route.query.id);
        const todoList = ref();

        // 編集データセット
        const formValues = {
            task: route.query.task,
            content: route.query.content,
            memo: route.query.memo,
        };

        const serverError = "";
        // バリデーション一括設定
        const schema = object({
            task: string().required("※タスクは必須項目です。"),
            content: string().required("※詳細は必須項目です。"),
        });
        // スチーマー反映結果格納
        const { errors, meta, handleSubmit } = useForm({
            // バリデーション
            validationSchema: schema,
            // 初期表示
            initialValues: formValues,
        });
        // 各インプット格納
        const { value: task, handleChange: handleTask } = useField("task");
        const { value: content, handleChange: handleContent } =
            useField("content");
        const { value: memo } = useField("memo");
        // 更新クリック処理
        const onSubmit = handleSubmit(async (todoParam) => {
            // 新規登録処理
            await axios
                .post("/api/todoEdit", {
                    id: todoId,
                    task: todoParam["task"],
                    content: todoParam["content"],
                    memo: todoParam["memo"],
                })
                .then((response) => {
                    console.log(response);
                    response.data;
                    router.push({ path: "/" });
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

        //モーダルクリックチェック
        let showContent = ref(false);
        // エラーメッセージ格納
        let errorMsg = ref();
        // モーダルウィンドウを表示する.
        let openModal = (errorText) => {
            showContent.value = true;
            errorMsg.value = errorText;
        };
        //  モーダルウィンドを閉じる.
        let closeModal = () => {
            showContent.value = false;
        };

        return {
            task,
            content,
            memo,
            errors,
            meta,
            serverError,
            handleTask,
            handleContent,
            onSubmit,
            showContent,
            openModal,
            closeModal,
            errorMsg,
            todoList,
            todoId,
            deleteData,
        };
    },
};
</script>
