// インサート処理
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
            response.error = err.response.data.message;

            return response;
        });

    return response;
}

// 取得処理
export async function getTodoData() {
    let response = {
        res: "",
        error: "",
    };
    await axios
        .get("/api/todo")
        .then((res) => {
            response.res = res;
        })
        .catch((err) => {
            switch (err.response.status) {
                case 422:
                    response.error = err.response.data.message;
                    break;

                default:
                    response.error =
                        "サーバーエラーです。時間をおいてアクセスしてください。";
                    break;
            }
        });
    return response;
}
