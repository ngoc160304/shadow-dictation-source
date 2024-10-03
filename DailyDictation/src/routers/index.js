import Home from "../pages/client/Home";
import AllTopics from "../pages/client/AllTopics";
import ExerciseTopic from "../pages/client/ExerciseTopic";
import Login from "../pages/client/Login";
import Register from "../pages/client/Register";
import LayoutClient from "../layouts/LayoutClient";
import LayoutLogin from "../layouts/LayoutLogin";
import ListenAndType from "../pages/client/Listen&Type";
import TopUser from "../pages/client/TopUser";
import VideoLession from "../pages/client/VideoLession";
// import PrivateRouter from "../components/client/PrivateRouter";
const routers = [
    {
        path: "/",
        element: <LayoutClient />,
        children: [
            {
                path: "/",
                element: <Home />
            },
            {

                path: "/all-topics",
                element: <AllTopics />,

            },
            {

                path: "/topic/:idTopic",
                element: <ExerciseTopic />
            },
            {
                path: "/listen-and-type/:idExercise",
                element: <ListenAndType />
            },
            {
                path: "/top-user",
                element: <TopUser />
            },
            {
                path: "/video-lession",
                element: <VideoLession />
            }
        ]
    },
    {
        path: "/",
        element: <LayoutLogin />,
        children: [
            {
                path: "/login",
                element: <Login />
            },
            {
                path: "/register",
                element: <Register />
            }
        ]
    }
]

export default routers;