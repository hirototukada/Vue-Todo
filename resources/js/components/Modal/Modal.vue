<template>
    <div
        class="modal-background"
        v-if="errors.show == true"
        @click="errors.switch()"
    ></div>
    <div class="modal-dialog" v-if="errors.show == true">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-light">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-exclamation-circle"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
                        />
                        <path
                            d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"
                        />
                    </svg>
                    エラー
                </h6>
            </div>
            <div class="modal-content-text">※{{ errors.massage }}</div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import { useErrorStore } from "../../stores/error";

export default defineComponent({
    setup(props, context) {
        // piniaでエラー共通生成
        const errors = useErrorStore();

        return {
            errors,
        };
    },
    props: ["errorMsg"],
});
</script>

<style>
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
    pointer-events: auto;
}

.modal-dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 101;
    pointer-events: none;
    height: 20%;
}

.modal-content {
    height: 100%;
}

.modal-content-text {
    align-items: center;
    margin: auto;
    padding: 10px;
    color: red;
}

.modal-header {
    background-color: rgb(227, 0, 0);
}
</style>
