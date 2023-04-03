// インサート処理
export async function userEntry(userParam) {
    let response = {
        res: "",
        error: "",
    };
    await axios
        .post("api/userEntry", {
            name: userParam["name"],
            email: userParam["email"],
            password: userParam["password"],
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
