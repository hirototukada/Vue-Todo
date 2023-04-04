<template>
    <transition name="fade">
        <Modal v-if="error.show"></Modal>
    </transition>
    <h1 class="mt-3 text-center">Todo編集</h1>
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
                        class="form-control text-truncate"
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
            <div class="d-flex justify-content-end">
                <!-- 削除ボタンコンポーネント -->
                <Delete :todoId="todoId" v-on:open="openModal" />
                <!-- 更新ボタン -->
                <div class="ml-2">
                    <button
                        :disabled="!meta.valid"
                        type="button"
                        class="btn btn-primary text-end"
                        @click="onSubmit"
                    >
                        更新する
                    </button>
                </div>
                <!-- 更新用コンポーネント -->
                <Edit ref="edit" />
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
import Delete from "./Model/Delete.vue";
import Edit from "./Model/Edit.vue";
import { useErrorStore } from "../../../stores/error";

// テンプレート表示
export default {
    components: {
        Modal,
        Delete,
        Edit,
    },
    setup(props) {
        // get取得用
        const route = useRoute();
        const todoId = ref(route.query.id);

        const error = useErrorStore();

        // 編集データセット
        const formValues = {
            task: route.query.task,
            content: route.query.content,
            memo: route.query.memo,
        };

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

        // 更新用作動用
        const edit = ref();
        // 更新クリック処理
        const onSubmit = handleSubmit(async (todoParam) => {
            edit.value.editData(todoParam, todoId.value);
        });

        return {
            task,
            content,
            memo,
            errors,
            meta,
            handleTask,
            handleContent,
            onSubmit,
            todoId,
            edit,
            error,
        };
    },
};
</script>
