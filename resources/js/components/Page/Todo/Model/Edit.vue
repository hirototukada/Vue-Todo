<template></template>
<script>
import { defineComponent } from "vue";
import { useRouter } from "vue-router";
import { useErrorStore } from "../../../../stores/error";

export default defineComponent({
    setup(props, context) {
        const router = useRouter();
        // 更新処理
        const editData = async (todoParam, todoId) => {
            try {
                await axios
                    .post("/api/todoEdit", {
                        id: todoId,
                        task: todoParam["task"],
                        content: todoParam["content"],
                        memo: todoParam["memo"],
                    })
                    .then((response) => {
                        response.data;
                        router.push({ path: "/" });
                    });
            } catch (err) {
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
                error.massage = errorText;
                error.switch();
            }
        };

        const error = useErrorStore();
        return {
            editData,
            error,
        };
    },
});
</script>
