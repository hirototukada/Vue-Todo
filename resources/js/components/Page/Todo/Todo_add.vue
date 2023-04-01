<template>
    <transition name="fade">
        <Modal
            v-if="showContent"
            :errorMsg="errorMsg"
            v-on:close="closeModal()"
        ></Modal>
    </transition>
    <h1 class="mt-3 text-center">タスク追加パーツ</h1>
    <div class="w-75 m-auto">
        <form>
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
            <!-- 追加ボタン -->
            <div class="text-right">
                <button
                    :disabled="!meta.valid"
                    type="button"
                    class="btn btn-primary text-end"
                    @click="onSubmit"
                >
                    追加する
                </button>
            </div>
        </form>
    </div>
</template>

<script>
// バリデーション用プラグイン
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
import { useRouter } from "vue-router";
import Modal from "../../Modal/Modal.vue";
import { defineComponent, ref } from "@vue/runtime-core";
import { add } from "../../../common";

// テンプレート表示
export default {
    components: {
        Modal,
    },
    setup() {
        const router = useRouter();
        const serverError = "";
        // バリデーション一括設定
        const schema = object({
            // task: string().required("※タスクは必須項目です。"),
            // content: string().required("※詳細は必須項目です。"),
        });
        // スチーマー反映結果格納
        const { errors, meta, handleSubmit } = useForm({
            // バリデーション
            validationSchema: schema,
            // 初期表示
            initialValues: {
                task: "",
                content: "",
                memo: "",
            },
        });
        // 各インプット格納
        const { value: task, handleChange: handleTask } = useField("task");
        const { value: content, handleChange: handleContent } =
            useField("content");
        const { value: memo } = useField("memo");
        // 追加クリック処理
        const onSubmit = handleSubmit(async (todoParam) => {
            add(todoParam, router);
            // 新規登録処理
            // await axios
            //     .post("api/todoAdd", {
            //         task: todoParam["task"],
            //         content: todoParam["content"],
            //         memo: todoParam["memo"],
            //     })
            //     .then((response) => {
            //         response.data;
            //         return router.push({ path: "/home", query: response });
            //     })
            //     .catch((err) => {
            //         let errorText = err.response.data.message;
            //         return openModal(errorText);
            //     });
            // 結果表示
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
        };
    },
};
</script>
