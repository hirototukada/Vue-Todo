export async function add(todoParam, router) {
    await axios
        .post("api/todoAdd", {
            task: todoParam["task"],
            content: todoParam["content"],
            memo: todoParam["memo"],
        })
        .then((response) => {
            response.data;
            return router.push({ path: "/", query: response });
        })
        .catch((err) => {
            console.log(err);

            let errorText = err.response.data.message;
            return errorText;
        });
}
