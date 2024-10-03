import { getCookie } from "../helpers/cookie";

const id = getCookie("id");
let initialValueClient;
if (id) {
    initialValueClient = localStorage.getItem("token")
} else {
    localStorage.clear();
    initialValueClient = null;
}
export const authenReducerClient = (state = initialValueClient || "", action) => {
    if (action.type === "SUCCESS") {
        return action.status;
    }
    else if (action.type === "FAILURE") {
        return action.status;
    }
    else {
        return state;
    }
}
export const authenReducerAdmin = (state = "", action) => {
    if (action.type === "CHECK_AUTHEN_ADMIN") {
        return action.status;
    } else {
        return state;
    }
}
