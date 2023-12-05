
import { createBrowserRouter, RouterProvider } from "react-router-dom"
import { createElement } from "react"
import { routes } from "./routes/route"

function App() {

  const router = createBrowserRouter(
    routes.map((route) => ({ 
      ...route,
      element: createElement(route.element),
    }))
  )

  return (
    
        <RouterProvider router={router}/>
     
  )
}

export default App
