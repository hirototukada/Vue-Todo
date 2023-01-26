<script>
// 登録処理
export async function insertTodo(todoParam) {
    await axios
        .post("api/todoAdd", {
            task: todoParam["task"],
            content: todoParam["content"],
            memo: todoParam["memo"],
        })
        .then((response) => {
            return response.data;
        })
        .catch((err) => {
            return console.log(err.response.data.errors);
        });
}
</script>
