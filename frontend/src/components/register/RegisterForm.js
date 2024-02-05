import React from 'react'
import AuthCard from '../auth/AuthCard'
import FormInput from '../UI/Input/FormInput'
import { useState } from 'react'
import SignUpWithGoogle from '../UI/button/SignUpWithGoogle'
import SubmitButton from '../UI/button/SubmitButton'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth'
import { validate } from '@/helpers/CheckValidationError'

const RegisterForm = () => {

  //call register function from useAuth() hook
  const { register } = useAuth()
  
  
  //define states
  const[inputValues,setInputValues]=useState({
    name:"",
    email:"",
    password:"",
    password_confirmation:"",
    phone_number:""
  })

  //define message
  const [message, setMessage]=useState("")
  
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
          label:"Username",
          type:"text",
          name:"name",
          placeholder:"Enter your name",
          errorMessage:"",
          required:true
        },
        {
          id:2,
          label:"Email",
          type:"email",
          name:"email",
          placeholder:"Enter your email",
          errorMessage:"",
          required:true
        },

        {
          id:3,
          label:"Password",
          type:"password",
          name:"password",
          placeholder:"Enter your password",
          errorMessage:"",
          required:true
        },
        {
          id:4,
          label:"Confirm Password",
          type:"password",
          name:"password_confirmation",
          placeholder:"Enter your Confirm Password",
          errorMessage:"",
          required:true
        },
      
        {
          id:5,
          label:"Phone Number",
          type:"text",
          name:"phone_number",
          placeholder:"Enter Your Phone Number",
          errorMessage:"",
          required:true
        },
      ]

      //check any validation error in 
  const isObjectEmpty = (objectName) => {
  return (
    objectName &&
    Object.keys(objectName).length === 0 &&
    objectName.constructor === Object
  );

};

const handleSubmit=(event)=>{
  event.preventDefault()

  let sendBtn=document.getElementById("sendBtn")

  //client-side validation
  const errors=validate(inputValues)

  console.log("[register-errors]",errors)

  //set validatorError state
  setValidationErrors(errors)

  if(!isObjectEmpty(errors)){
      return
  }else{

      //extract all inputValues
      const{name,email,password,password_confirmation,phone_number}=inputValues

      //dispatch action
      console.log("[register]",inputValues)

      //useAuth hook
      register({ name, email, password, password_confirmation, phone_number, setErrors, setMessage })

      //trigger dispatch register action if you use redux

      // dispatch(loginUser(values))
  

      //change submit button value
      sendBtn.innerHTML="Submitting....."

   

      //reset form
      setInputValues({
          name:"",  
          email:"",
          password:"",
          password_confirmation:"",
          phone_number:""
      })

      sendBtn.innerHTML="send"
  }

}





  return (
    <div className='container'>
    <div className="row d-flex justify-content-center align-items-center">
        <div className="errors">
          <h2>{message}</h2>
        </div>
        <div className="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            <AuthCard 
              title='Register' 
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
                <SubmitButton
                  type="submit"
                  id="sendBtn"
                  className='mb-2'
                >
                  Register
                </SubmitButton>
                <div className="d-flex flex-column justify-content-center align-items-center mb-2">
                        <Link href='/login' className='mb-2'>Do not have an account?</Link>
                        <Link href='/forgetpassword' >forget password?</Link>
                        </div>
            </AuthCard>
        </div>
        <div className="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <AuthCard title='Social Login'>
              <SignUpWithGoogle>sign with google</SignUpWithGoogle>
            </AuthCard>
        </div>
    </div>
    </div>
  )
}

export default RegisterForm