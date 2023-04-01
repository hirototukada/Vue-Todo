// インサート処理
export async function userSign(userParam) {
    let response = {
        res: "",
        error: "",
    };
    await axios
        .post("api/todoAdd", {
            name: userParam["name"],
            email: userParam["email"],
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
