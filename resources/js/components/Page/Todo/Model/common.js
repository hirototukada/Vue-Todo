export async function add(todoParam) {
    let response = {
        res: "",
        error: "",
    };
    await axios
        .post("api/todoAdd", {
            task: todoParam["task"],
            content: todoParam["content"],
            memo: todoParam["memo"],
        })
        .then((res) => {
            response["res"] = res;
        })
        .catch((err) => {
            console.log(err.response.data.message);
            response.error = err.response.data.message;

            return response;
        });

    return response;
}
