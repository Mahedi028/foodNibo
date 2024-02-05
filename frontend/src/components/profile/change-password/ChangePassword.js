import AuthCard from '@/components/auth/AuthCard'
import React from 'react'
import classes from '../profile.module.css'
import Image from 'next/dist/client/image'
import { useState } from 'react'
import Link from 'next/dist/client/link'
import { validate } from '@/helpers/CheckValidationError'
import FormInput from '@/components/UI/Input/FormInput'
import SubmitButton from '@/components/UI/button/SubmitButton'

const ChangePassword = () => {


    //define input states
    const [values, setValues]=useState({
        password:"",
        password_confirmation:"",
    })

    //define error states
    const [validationErrors, setValidationErrors]=useState({})

    //define input states
    const inputs=[
        {
            id:1,
            type:"password",
            name:"password",
            placeholder:"Enter Password",
            label:"Password",
            // errorMessage:"Password should be 8-20 characters and include at least 1 letter, 1 number and 1 special character",
            errorMessage:validationErrors.password,
            pattern:"^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$",
            // required:true
        },
        {
            id:2,
            type:"password",
            name:"password_confirmation",
            placeholder:"Enter Confirm Password",
            label:"Confirm Password",
            // errorMessage:"Password don't match",
            errorMessage:validationErrors.password_confirmation,
            pattern:"^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$",
            // required:true
        },
    ]

    //input change handler
    const handleInputChange=(e)=>{
        setValues({...values, [e.target.name]:e.target.value})
    }

    //check empty validationError objects
    const isObjectEmpty = (objectName) => {
        return (
          objectName &&
          Object.keys(objectName).length === 0 &&
          objectName.constructor === Object
        );

    };

    //submit handler
    const handleSubmit=(event)=>{
        event.preventDefault()

        let sendBtn=document.getElementById("sendBtn")

        //client-side validation
        const errors=validate(values)

        setValidationErrors(errors)

        if(!isObjectEmpty(errors)){
            //if any errors occur return null and do not submit the input values
            return
        }else{
            //if no errors occur then input values submit in the backend
            const{password,password_confirmation}=values

            //create an instance FormData
            // const formData=new FormData()

            //send input value in the backend

            // formData.append("password",password)
            // formData.append("password_confirmation",password_confirmation)


            //change submit button value
            sendBtn.innerHTML="Submitting....."

            //console
            console.log("Form Data");
            for (let obj of formData) {
                console.log(obj);
            }
            //configure api url and axios


            //reset form
            setValues({
                password:"",
                password_confirmation:"",
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
                        title='Change password'
                    >
                      {
                            inputs.map((input)=>{
                                return <FormInput
                                            key={input.id}
                                            {...input}
                                            value={values[input.name]}
                                            className="mb-2"
                                            onChange={handleInputChange}
                                        />
                            })
                        }
                        <SubmitButton
                            type="submit"
                            id="sendBtn"
                        >Change Password</SubmitButton>
                    </AuthCard>
                </div>
            </div>
        </div>
    </div>
  )
}

export default ChangePassword