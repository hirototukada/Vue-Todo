<template>
    <div class="text-right">
        <button type="button" class="btn btn-danger text-end" @click="onDelete">
            削除する
        </button>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
    props: ["todoId"],
    setup(props, context) {
        const router = useRouter();
        // 削除処理
        const onDelete = async () => {
            await axios
                .delete("/api/todoDelete/" + props.todoId)
                .then((res) => {
                    console.log(res.status);
                    // homeに返す
                    return router.push({ name: "home" });
                })
                .catch((err) => {
                    console.log(err);
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
