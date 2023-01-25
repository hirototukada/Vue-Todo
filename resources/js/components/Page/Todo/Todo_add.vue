<template>
    <h1 class="mt-3 text-center">タスク追加パーツ</h1>
    <div class="w-75 m-auto">
        <form>
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
    <!-- 参考 -->
    <!-- バリデーション結果（初期表示はfalse） -->
    <p>valid:{{ meta.valid }}</p>
    <!-- 記入されたかどうか（初期表示から入力されたか） -->
    <p>dirty:{{ meta.dirty }}</p>
    <!-- 初期表示 -->
    <p>initialValue:{{ meta.initialValue }}</p>
</template>

<script>
// バリデーション用プラグイン
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
import { useRouter } from "vue-router";
import { externalFunc } from "../../../functions/Todo/Todo_model.vue";
// テンプレート表示
export default {
    setup() {
        const router = useRouter();
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
        const onSubmit = handleSubmit((values) => {
            router.push({ path: "/home", query: values });
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
        };
    },
};
</script>
