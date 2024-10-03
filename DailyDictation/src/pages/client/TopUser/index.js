import { getTopUserList } from "../../../services/userService";
import "./TopUser.css";
import { useEffect, useState } from "react";
const TopUser = () => {
    const [topUserList, setTopUserList] = useState([]);
    const fetchApi = async () => {
        const getTopUser = await getTopUserList();
        console.log(getTopUser);
        setTopUserList(getTopUser);
    }

    useEffect(() => {
        fetchApi();
    }, [])
    return (
        <>
            <div className="top-user container">
                <table className="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Active time</th>
                        </tr>
                    </thead>
                    <tbody>
                        {

                        }
                        <tr>
                            <th >1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </>
    )
}
export default TopUser;