<template>
    <h1 class="mt-3 text-center">タスク追加パーツ</h1>
    <div class="w-75 m-auto">
        <form>
            <div class="mb-3 d-flex">
                <label for="exampleInputEmail1" class="form-label w-25">
                    タスク：
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="task"
                    v-model="task"
                    aria-describedby="taskHelp"
                    @blur="handleTask"
                />
            </div>
            <p class="text-danger">{{ errors.task }}</p>
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
                    type="submit"
                    class="btn btn-primary text-end"
                >
                    追加する
                </button>
            </div>
        </form>
    </div>
    <p>valid:{{ meta.valid }}</p>
    <p>dirty:{{ meta.dirty }}</p>
    <p>initialValue:{{ meta.initialValue }}</p>
</template>

<script>
// バリデーション用プラグイン
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
// テンプレート表示
export default {
    setup() {
        // バリデーション一括設定
        const schema = object({
            memo: string().required("※メモは必須項目です。"),
            task: string().required("※タスクは必須項目です。"),
        });
        // スチーマー反映結果格納
        const { errors, meta } = useForm({
            validationSchema: schema,
        });
        // 各インプット格納
        const { value: task, handleChange: handleTask } = useField("task");
        const { value: memo, handleChange: handleMemo } = useField("memo");

        return {
            memo,
            task,
            errors,
            meta,
            handleTask,
            handleMemo,
        };
    },
};
</script>
