<template>
    <div class="modal-dialog w-100">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-danger">
                    {{ errorMsg }}
                </p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    v-on:click="closeModal()"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
    setup(props, context) {
        /**
         * モーダルウィンドを閉じる.
         */
        let closeModal = () => {
            context.emit("close");
        };

        return {
            closeModal,
        };
    },
    props: ["errorMsg"],
});
</script>
