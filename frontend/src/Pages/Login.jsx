import LoginForm from "../Components/LoginForm";
import {useContext} from "react";
import JWTContext from "../JWTContext";

export default function Login() {
    const {checkToken} = useContext(JWTContext);
    checkToken();

    return (
      <div className="flex justify-center items-center w-full h-[80vh]">
        <LoginForm/>
      </div>
    );
  }
  
