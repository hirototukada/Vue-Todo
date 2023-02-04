<template>
    <div class="text-right">
        <button type="button" class="btn btn-danger text-end" @click="onDelete">
            削除する
        </button>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["todoId"],
    setup(props, context) {
        // 削除処理
        const onDelete = async () => {
            await axios
                .delete("/api/todoDelete", { id: props.todoId })
                .then((res) => {
                    console.log(res.status);
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
                    // return openModal(errorText);
                });
        };
        return {
            onDelete,
        };
    },
});
</script>
