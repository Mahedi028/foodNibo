// "use client"
import AuthCard from '@/components/auth/AuthCard'
import React,{useEffect, useState} from 'react'
import classes from '../profile.module.css'
import Image from 'next/dist/client/image'
import Link from 'next/dist/client/link'
import FormInput from '@/components/UI/Input/FormInput'
import SubmitButton from '@/components/UI/button/SubmitButton'
import { useAuth } from '@/hooks/auth'
import { toast } from 'react-toastify'
import { useRouter } from 'next/router'
import { useSession } from 'next-auth/react'

export const ProfileEdit = () => {

    const router=useRouter()

    const { data: session, update} = useSession()




    const {user:currentUser, updateProfile, updateSession}=useAuth()

    const {id,name,email,phone_number}=currentUser?.data || {}

    //define input states
    const [inputValues, setInputValues]=useState({
        name:"",
        email:"",
        phone_number:""
    })



    //define errors
    const[errors, setErrors]=useState([])

    //define status
    const [status, setStatus]=useState(false)

    //define error states
    const [validationErrors, setValidationErrors]=useState({})


    useEffect(async() =>{
        if(currentUser){
            setInputValues({
                name:name?name:"",
                email:email?email:"",
                phone_number:phone_number?phone_number:""
            })
        }

        if(errors){
            console.log("[edit-error]",errors)
        }
        if(status){
            toast.success("Profile Updated Successfully",{
                position: toast.POSITION.TOP_CENTER,
                autoClose: 15000
            });
            
            updateSession({setErrors,setStatus})
            router.reload();
        }
      
    }, [currentUser, status, errors, update])


    

    
    //define all fields of input
    const inputs=[
        {
            id:1,
            type:"text",
            name:"name",
            placeholder:"Enter Username",
            label:"Username",
            // errorMessage:"Username should be 3-16 characters and shouldn't include any special character",
            errorMessage:validationErrors.username,
            // pattern:"^[A-Za-z0-9]{3,16}$",
            // required:true
        },
        {
            id:2,
            type:"email",
            name:"email",
            placeholder:"Enter Email",
            label:"Email",
            // errorMessage:"It should be a valid email address",
            errorMessage:validationErrors.email,
            // pattern:"/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",
            // required:true
        },
        {
            id:3,
            type:"text",
            name:"phone_number",
            placeholder:"Enter Phone Number",
            label:"Phone Number",
            // errorMessage:"Enter phone number",
            errorMessage:validationErrors.phone_number,
            // pattern:values.phone_number,
            // required:true
        },
    ]

    //handle all input fields
    const handleInputChange=(e)=>{
        setInputValues({...inputValues, [e.target.name]:e.target.value})
    }

    //check empty validationError objects
    const isObjectEmpty = (objectName) => {
        return (
          objectName &&
          Object.keys(objectName).length === 0 &&
          objectName.constructor === Object
        );

    };

    const validate=(inputValues)=>{
        const errors={};
        const nameRegex= /^[A-Za-z0-9]{3,16}$/;
        const emailRegex= /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
        const passwordRegex= /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i;
      
      
        // if(!inputValues.name){
        //   errors.name="Username is required";
        // }else if(!nameRegex.test(inputValues.username)){
        //   errors.name="Username should be 3-16 characters and shouldn't include any special character"
        // }

        if(!inputValues.email){
            errors.email="Email is required";
        }else if(!emailRegex.test(inputValues.email)){
            errors.email="It should be a valid email address";
        }
        
        // if(inputValues.password_confirmation!=inputValues.password){
        //   errors.password_confirmation="Password do not matched"
        // }
        if(!inputValues.phone_number){
          errors.phone_number="Phone Number is required"
        }
    
    
      
        return errors
      }


    const handleSubmit=(event)=>{
        event.preventDefault()

        let sendBtn=document.getElementById("sendBtn")

        //client-side validation
        const errors=validate(inputValues)

        setValidationErrors(errors)

        if(!isObjectEmpty(errors)){
            //if any errors occur return null and do not submit the input values
            return
        }else{
            //if no errors occur then input values submit in the backend
            const{name,email,phone_number}=inputValues

            console.log("[input]",inputValues)

            //use auth hook
            updateProfile({id,name,email,phone_number,setErrors,setStatus})

            



            //create an instance FormData
            // const formData=new FormData()

            //send input value in the backend
            // formData.append("name",username)
            // formData.append("email",email)
            // formData.append("phone_number",phone_number)

            //change submit button value
            sendBtn.innerHTML="Submitting....."

            //console
            // console.log("Form Data");
            // for (let obj of formData) {
            //     console.log(obj);
            // }
            //configure api url and axios


            //reset form
            setInputValues({
                name:"",
                email:"",
                phone_number:""
            })
        }
    }











  return (
    <div className={`${classes.profile__container} container`}>
        <div className="row d-flex justify-content-center align-item-center">
            <div className="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div className={classes.user__details}>
                    <Image
                        src='/images/logo/apple.png'
                        width={150}
                        height={150}
                        className={classes.user__image}
                        alt='User'
                    />
                    <div className={classes.user__details__item}>
                        <Link href='/profile/edit' className='text-decoration-none'><h6>Profile</h6></Link>
                    </div>
                    <div className={classes.user__details__item}>
                        <Link href='/profile/change-password' className='text-decoration-none'><h6>Change Password</h6></Link>
                    </div>
                    <div className={classes.user__details__item}>
                        <Link href='/profile/user/orders' className='text-decoration-none'><h6> My Orders</h6></Link>
                    </div>
                </div>
            </div>
            <div className="col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                <div className={classes.user__details__content}>
                    <AuthCard
                        title='Profile Edit'
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
                            // onClick={()=>update({
                            //                 name:inputValues?.name,
                            //                 email:inputValues?.email,
                            //                 phone_number:inputValues?.phone_number
                            //             })}
                        >Edit</SubmitButton>
                    </AuthCard>
                </div>
            </div>
        </div>
    </div>
  )
}
