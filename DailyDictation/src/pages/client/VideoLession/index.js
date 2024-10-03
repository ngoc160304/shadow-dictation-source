import { useEffect, useState } from "react";
import { getListVedioLession } from "../../../services/videoLessionService";
import "./VideoLession.css"
import { Link } from "react-router-dom";
const VideoLession = () => {
    const [VedioLession, setVideolession] = useState([]);
    const fetchApi = async () => {
        const getVedioLession = await getListVedioLession();
        setVideolession(getVedioLession.videos)
    }
    useEffect(() => {
        fetchApi();
    }, [])
    const openInNewTab = (e, link) => {
        e.preventDefault();
        window.open(link, '_blank');
    };
    return (
        <>
            <div className="container">
                <div className="vedio-lession">
                    <h1>Video Lession</h1>
                    <ul className="story-list">
                        {
                            VedioLession.map((item, index) => {
                                return (
                                    <li key={item.id}>
                                        <Link to={item.link_youtube} onClick={(e) => { openInNewTab(e, item.link_youtube) }}>
                                            {index + 1}. {item.title}
                                        </Link>
                                    </li>
                                )
                            })
                        }
                    </ul>
                </div>
            </div>
        </>
    )
}

export default VideoLession;