<template>
    <!-- エラー表示 -->
    <transition name="fade">
        <Modal
            v-if="showContent"
            :errorMsg="errorMsg"
            v-on:close="closeModal()"
        ></Modal>
    </transition>
    <h1 class="text-center mt-3 mb-3">Todo</h1>
    <div class="w-75 m-auto">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">完了チェック</th>
                    <th scope="col">タスク</th>
                    <th scope="col">詳細</th>
                    <th scope="col">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-pencil-square"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                            />
                            <path
                                fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                            />
                        </svg>
                        メモ
                    </th>
                    <th scope="col">編集</th>
                </tr>
            </thead>
            <Todo_list v-on:open="openModal"></Todo_list>
        </table>
        <div class="text-right">
            <router-link class="mr-3" to="/todoAdd">
                <button type="button" class="mt-4 btn btn-primary">
                    タスクの追加
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import Modal from "../Modal/Modal.vue";
import Todo_list from "./Todo/Todo_list.vue";

export default {
    components: {
        Modal,
        Todo_list,
    },
    setup() {
        const route = useRoute();
        const router = useRouter();

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
            showContent,
            openModal,
            closeModal,
            errorMsg,
        };
    },
};
</script>
<style>
.link {
    color: #007bff;
    cursor: pointer;
}
</style>
