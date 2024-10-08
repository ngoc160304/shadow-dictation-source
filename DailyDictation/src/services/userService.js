import { get, post, postEndTime, postLogin, postLogout, postRegister, postStartTime, postTest } from "../utils";
import "core-js/stable/atob";
export const getUser = async (data) => {
    try {
        const result = await postLogin(`login`, data);
        if (result.token) {
            localStorage.setItem("token", result.token);
        }
        return result;
    } catch (error) {
        throw error;
    }
}
export const getUserById = async (id) => {
    if (id !== "") {
        const result = await get(`users?id=${id}`);
        return result;
    }
    else {
        return [];
    }
}
export const getUserByToken = async (token) => {
    if (token !== "") {
        const result = await get(`users?token=${token}`);
        return result;
    } else {
        return [];
    }
}
export const checkUserExist = async (data) => {
    const result = await get(`users?email=${data.username}`);
    return result;
}
export const createUser = async (data) => {
    const result = await postRegister(`register`, data);
    return result;
}

export const getTopUserList = async (limit = 30) => {
    const result = await get(`users/top?_limit=${limit}&_sort=endTime`);
    return result;
}
export const userLogout = async () => {
    const result = await postLogout('logout');
    return result;
}
export const userStartTime = async () => {
    const result = await postStartTime('start-time');
    return result;
}

export const userEndTime = async () => {
    const result = await postEndTime('end-time');
    return result;
}