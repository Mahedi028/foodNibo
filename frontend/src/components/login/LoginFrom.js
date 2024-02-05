"use client";
import React, { useEffect } from 'react'
import AuthCard from '../auth/AuthCard'
import FormInput from '../UI/Input/FormInput'
import { useState } from 'react'
import SignUpWithGoogle from '../UI/button/SignUpWithGoogle'
import SubmitButton from '../UI/button/SubmitButton'
import Link from 'next/link'
import { signIn,useSession } from "next-auth/react"
import { useRouter } from 'next/router';
import HttpService from '@/lib/HttpService';

const LoginForm = () => {

  //get google-login redirect url
  const [googleRedirectLoginUrl,setGoogleRedirectLoginUrl]=useState("")

  //extract session 
  const {data:session}=useSession()
  const router=useRouter()

  useEffect(() => {
    //send get request to backend and get google-callback-login redirect url
    HttpService.get("/api/v1/login/google/redirect")
                .then((res)=>{
                  setGoogleRedirectLoginUrl(res?.data?.data)
                  console.log("[google]",res?.data?.data)
                })
    
  }, [])
  
  //define states
  const[inputValues,setInputValues]=useState({
    email:"",
    password:"",
  })
  
  //define errors
  const [errors, setErrors] = useState([])
  
  //define validation errors state
  const [validationErrors, setValidationErrors]=useState({})
  //handleInput Values
  const handleInputChange=(e)=>{
    setInputValues({...inputValues, [e.target.name]:e.target.value})
  }
  
  //all input fields
  const inputs=[
        {
          id:1,
          label:"Email",
          type:"email",
          name:"email",
          placeholder:"Enter your email",
          errorMessage:"",
          required:true
        },

        {
          id:2,
          label:"Password",
          type:"password",
          name:"password",
          placeholder:"Enter your password",
          errorMessage:"",
          required:true
        },
       
      ]
      
      //handling input errors
        const validate=(inputValues)=>{
            const errors={};
            const emailRegex= /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
            const passwordRegex= /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i;

            if(!inputValues.email){
                errors.email="Email is required";
            }else if(!emailRegex.test(inputValues.email)){
                errors.email="It should be a valid email address";
            }

            if(!inputValues.password){
                errors.password="Password is required";
            }else if(inputValues.password.length < 4){
                errors.password="Password must be more than 4 characters";
            }else if(inputValues.password.length > 15){
                errors.password="Password cannot exceed more than 10 characters";
            }else if(!passwordRegex.test(inputValues.password)){
                errors.password="Password should be 8-20 characters and include at least 1 letter, 1 number and 1 special character"
            }
            return errors
        }
        
        const isObjectEmpty = (objectName) => {
          return (
            objectName &&
            Object.keys(objectName).length === 0 &&
            objectName.constructor === Object
          );
        };

    const handleSubmit=async(event)=> {
      event.preventDefault()

      let sendBtn=document.getElementById("sendBtn")

      //client-side validation
      const errors=validate(inputValues)

      console.log("[register-errors]",errors)

      setValidationErrors(errors)

      if(!isObjectEmpty(errors)){
          return
      }else{

          console.log("[email]",inputValues.email)

          //send user credentials in next-auth signIn()
          const result= await signIn('credentials',{
            redirect:false,
            ...inputValues,
          })
          .then((res) =>{
            console.log("[login-response]",res)
          })
          .catch((error) =>{
            console.log("[login-error]",error)
            //set errors state
            // setErrors(error)
          });

          //dispatch action
          console.log("[register]",inputValues)
          console.log("[result]",result)

          if(result?.error){
            console.log("[login-error]",result.error)
            //set errors
            setErrors(result.error)
          }else{
            setInputValues({
              email:"",
              password:"",
            })

          sendBtn.innerHTML="send"
          //redirect login page
          window.location.href='/login'
          }

        

          // dispatch(loginUser(values))


          //change submit button value
          sendBtn.innerHTML="Submitting....."

          //reset form
          setInputValues({
              email:"",
              password:"",
          })

          sendBtn.innerHTML="send"
      }

    }

  if(session && session?.user){
    router.push('/')
  }
  return (
    <div className='container d-flex justify-content-center align-items-center'>
    <div className="row">
        <div className="col-lg-4 offset-lg-2 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
            <AuthCard 
              title='login' 
              onSubmitHandler={handleSubmit}
              errors={validationErrors}
            >
                {
                    inputs.map((input)=>{
                        return <FormInput
                                            key={input.id}
                                            {...input}
                                            value={inputValues[input.name]}
                                            className="mb-2"
                                            onChange={handleInputChange}
                                        />
                    }) 
                }
                {/* <input name="csrfToken" type="hidden" defaultValue={csrf} /> */}
                {/* <input name="csrfToken" type="hidden" defaultValue={csrfToken} /> */}
                <SubmitButton
                  type="submit"
                  id="sendBtn"
                  className='mb-2'
                >
                  Login
                </SubmitButton>
                <div className="d-flex flex-column justify-content-center align-items-center mb-2">
                        <Link href='/register' className='mb-2'>Do not have an account?</Link>
                        <Link href='/forgetpassword' >forget password?</Link>
                        </div>
            </AuthCard>
        </div>
        <div className="col-lg-4 offset-lg-2 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
            <AuthCard title='Social Login'>
              <Link href={googleRedirectLoginUrl}>
                <SignUpWithGoogle>sign with google</SignUpWithGoogle>
              </Link>
            </AuthCard>
        </div>
    </div>
    </div>
  )
}

export default LoginForm