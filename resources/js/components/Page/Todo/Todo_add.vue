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
                    メモ：
                </label>
                <p class="text-danger">{{ errors.memo }}</p>
                <div class="form-floating">
                    <textarea
                        class="form-control"
                        v-model="memo"
                        placeholder="～文字以内で入力してください。"
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
// テンプレート表示
export default {
    setup() {
        const router = useRouter();
        // バリデーション一括設定
        const schema = object({
            memo: string().required("※メモは必須項目です。"),
            task: string().required("※タスクは必須項目です。"),
        });
        // スチーマー反映結果格納
        const { errors, meta, handleSubmit } = useForm({
            // バリデーション
            validationSchema: schema,
            // 初期表示
            initialValues: {
                task: "",
                memo: "",
            },
        });
        // 各インプット格納
        const { value: task, handleChange: handleTask } = useField("task");
        const { value: memo, handleChange: handleMemo } = useField("memo");
        // 追加クリック処理
        const onSubmit = handleSubmit((values) => {
            console.log(values);
            router.push({ path: "/home", query: values });
        });

        return {
            memo,
            task,
            errors,
            meta,
            handleTask,
            handleMemo,
            onSubmit,
        };
    },
};
</script>
