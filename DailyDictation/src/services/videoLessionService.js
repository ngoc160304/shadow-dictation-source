import { get } from "../utils"

export const getListVedioLession = async () => {
    const result = await get(`/videoLessons`);
    return result
}