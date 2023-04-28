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
export async function getTodoData(page = 1, userId, userEmail = null) {
    let response = {
        res: "",
        error: "",
    };

    if (!userId) {
        userId = userEmail;
    }

    let apiUrl = "/api/todo/" + page + "/" + userId;
    if (page > 1) {
        apiUrl = "/api/todo/" + page + "/" + userId;
    }
    console.log(apiUrl);
    await axios
        .get(apiUrl)
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
