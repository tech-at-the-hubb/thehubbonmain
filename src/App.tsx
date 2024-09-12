import "./App.css";
import "./styles/grid.css";
import "./styles/colors.css";
import "./styles/typography.css";

import { createBrowserRouter, RouterProvider } from "react-router-dom";

import { Home } from "./pages/Home";
import { Calendar } from "./pages/Calendar";
import { Programming } from "./pages/Programming";

function App() {
  const router = createBrowserRouter([
    {
      path: "/",
      element: <Home />,
    },
    {
      path: "/calendar",
      element: <Calendar />,
    },
    {
      path: "/programming",
      element: <Programming />,
    },
  ]);

  return (
    <div className="App">
      <RouterProvider router={router} />
    </div>
  );
}

export default App;
