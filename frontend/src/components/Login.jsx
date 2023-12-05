import {Tabs, Tab, Input, Link, Button, Card, CardBody} from "@nextui-org/react";
import { useState } from "react";
import axios from 'axios';
import { useNavigate } from "react-router";



function Login() {
  
    const navigate = useNavigate();
    const [selected, setSelected] = useState("login");
    const [formLogin, setFormLogin] = useState({
      email: '',
      password: '',
    });
    const [formRegister, setFormRegister] = useState({
      usuario: '',
      email: '',
      password: '',
      password_confirmation: '',
    });

    const changeLogin = (e) => {
      const { name, value } = e.target;
      setFormLogin({
        ...formLogin,
        [name]: value,
      });
    };

    const changeRegister = (e) => {
      const { name, value } = e.target;
      setFormRegister({
        ...formRegister,
        [name]: value,
      });
    };

    const handleRegister = async (e) => {

      e.preventDefault();
      
      try {
    
          const response = await axios.post('http://127.0.0.1:8000/api/auth/register', formRegister)
          
          const token = response.data.token;
          localStorage.setItem("token", token);
          
          if(localStorage.getItem("token") != null ){
            navigate('/dashboard');
          } else {
            navigate('/');
          }
      } catch (error) {
          console.error('error al enviar solicitud:', error)
      }
    }
    const handleLogin = async (e) => {

      e.preventDefault();
      
      try {
    
          const response = await axios.post('http://127.0.0.1:8000/api/auth/login', formLogin)
          
          const token = response.data.token;
          localStorage.setItem("token", token);
          if(localStorage.getItem("token") != null ){
            navigate('/dashboard');
          } else {
            navigate('/');
          }

          
      } catch (error) {
          console.error('error al enviar solicitud:', error)
      }
    }
    
    return (
    <>
    <div className="grid h-screen items-center justify-center">
      <div className="flex flex-col content-center w-full">
        <Card className="max-w-full w-[340px] h-[450px]">
          <CardBody className="overflow-hidden">
            <Tabs
              fullWidth
              size="md"
              aria-label="Tabs form"
              selectedKey={selected}
              onSelectionChange={setSelected}
            >
              <Tab key="login" title="Login">
                <form onSubmit={handleLogin} className="flex flex-col gap-4">
                  <Input 
                    name="email"
                    id="email"
                    isRequired 
                    label="Email" 
                    placeholder="Enter your email" 
                    type="email"
                    value={formLogin.email}
                    onChange={changeLogin} 
                  />
                    
                  <Input
                    name="password"
                    id="password"
                    isRequired
                    label="Password"
                    placeholder="Enter your password"
                    type="password"
                    value={formLogin.password}
                    onChange={changeLogin}
                  />

                  <p className="text-center text-small">
                    Need to create an account?{" "}
                    <Link className="cursor-pointer" size="sm" onPress={() => setSelected("sign-up")}>
                      Sign up
                    </Link>
                  </p>
                  <div className="flex gap-2 justify-end">
                    <Button type="submit" fullWidth color="primary">
                      Login
                    </Button>
                  </div>
                </form>
              </Tab>
              <Tab key="sign-up" title="Sign up">
                <form onSubmit={handleRegister} className="flex flex-col gap-4 h-[350px]">
                  <Input 
                    name="name"
                    id="name"
                    isRequired 
                    label="Name" 
                    placeholder="Enter your name" 
                    type="text"
                    value={formRegister.name}
                    onChange={changeRegister} 
                  />
                  <Input 
                    name="email"
                    id="email"
                    value={formRegister.email}
                    isRequired 
                    label="Email" 
                    placeholder="Enter your email" 
                    type="email"
                    onChange={changeRegister} />
                  <Input
                    name="password"
                    id="password"
                    value={formRegister.password}
                    isRequired
                    label="Password"
                    placeholder="Enter your password"
                    type="password"
                    onChange={changeRegister}
                  />
                  <Input
                    name="password_confirmation"
                    id="password_confirmation"
                    value={formRegister.password_confirmation}
                    isRequired
                    label="Confirm your password"
                    placeholder="Confirm your password"
                    type="password"
                    onChange={changeRegister}
                  />
                  <p className="text-center text-small">
                    Already have an account?{" "}
                    <Link className="cursor-pointer" size="sm" onPress={() => setSelected("login")}>
                      Login
                    </Link>
                  </p>
                  <div className="flex gap-2 justify-end">
                    <Button type="submit" fullWidth color="primary">
                      Sign up
                    </Button>
                  </div>
                </form>
              </Tab>
            </Tabs>
          </CardBody>
        </Card>
      </div>
      </div>
      </>
    );
}

export default Login