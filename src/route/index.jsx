import { useRoutes, Navigate } from "react-router-dom";
import { Home, Login, Register } from "@/page";

export function Router() {
  return useRoutes([
    {
      path: "/",
      element: <Navigate to="/login" />,
    },
    {
      path: "/login",
      element: <Login />,
    },
    {
      path: "/register",
      element: <Register />,
    },
    {
      path: "/home",
      element: <Home />,
    },
  ]);
}
