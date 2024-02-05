import { useCheckout } from '@/hooks/checkout'
import React, { Fragment, useState, useEffect} from 'react'
// import { validate } from '@/helpers/CheckValidationError'
import classes from './checkout.module.css'
import AuthCard from '../auth/AuthCard'
import FormInput from '../UI/Input/FormInput'
import FormTextArea from '../UI/textarea/FormTextArea'
import FormSelect,{SelectOptions} from '../UI/formselect/FormSelect'
import CartButton from '../UI/button/CartButton'
import { useRouter } from 'next/router'
const Checkout = ({user}) => {

    const router=useRouter()
        //define all states
        const [inputValues, setInputValues]=useState({
            name:"",
            email:"",
            phone:"",
            address:"",
            post_code:"",
            division_id:1,
            district_id:1,
            state_id:1,
            payment_method:""
        })
    

    const {divisions,districts,states}=useCheckout({
        division_id:inputValues?.division_id,
        district_id:inputValues?.district_id,
    })


    console.log("[checkout-divisions]",divisions?.data)
    console.log("[checkout-districts]",districts?.data)

    

    // ValidationErrors
    const [validationErrors, setValidationErrors]=useState({})

    //define errors
    const [errors, setErrors] = useState([])


    //handleInputChange
    const handleInputChange=(e,option)=>{
        setInputValues({...inputValues, [e.target.name]:e.target.value, payment_method:option})
    }

    // input fields
    const inputs=[
        {
            id:1,
            type:"text",
            name:"name",
            placeholder:"Enter your name",
            label:"Name",
            // errorMessage:"Username should be 3-16 characters and shouldn't include any special character",
            errorMessage:validationErrors.name,
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
            pattern:"/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",
            // required:true
        },
        {
            id:3,
            type:"text",
            name:"phone",
            placeholder:"Enter Phone Number",
            label:"Phone Number",
            // errorMessage:"Enter phone number",
            errorMessage:validationErrors.phone,
            // pattern:values.phone_number,
            // required:true
        },
        {
            id:4,
            type:"text",
            name:"post_code",
            placeholder:"Enter PostCode",
            label:"Post Code",
            // errorMessage:"Enter phone number",
            errorMessage:validationErrors.post_code,
            // pattern:values.phone_number,
            // required:true
        },
    ]

    const validate=(values)=>{
        const errors={};
        const usernameRegex= /^[A-Za-z0-9]{3,16}$/;
        const emailRegex= /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i

        if(!inputValues.name){
            errors.name="Username is required";
        }else if(!usernameRegex.test(inputValues.username)){
            errors.name="Username should be 3-16 characters and shouldn't include any special character"
        }
        if(!inputValues.email){
            errors.email="Email is required";
        }else if(!emailRegex.test(inputValues.email)){
            errors.email="It should be a valid email address";
        }

        if(!inputValues.phone){
            errors.phone="Phone Number is required"
        }
        if(!inputValues.address){
            errors.address="Address is required"
        }
        if(!inputValues.post_code){
            errors.post_code="Post Code is required"
        }

        if(!inputValues.division_id){
            errors.division="Division is required"
        }

        if(!inputValues.district_id){
            errors.district="District is required"
        }
        if(!inputValues.payment_method){
            errors.payment_method="Payment Method is required"
        }

        return errors
    }

    //payment methods
    const options=[
        // {
        //     name:"bkash",
        //     src:'/images/payment/bkash.png'
        // },
        {
            name:"stripe",
            src:'/images/payment/stripe.png'
        },
        {
            name:"paypal",
            src:'/images/payment/paypal.jpg'
        },
        {
            name:"sslcommerz",
            src:'/images/payment/SSLCOMMERZ.png'
        },
    ]

    const onSelect=(option)=>{
        setInputValues({...inputValues,payment_method:option});
    }



    const isObjectEmpty = (objectName) => {
        return (
          objectName &&
          Object.keys(objectName).length === 0 &&
          objectName.constructor === Object
        );
      
      };



      const paymentOptionView=options?.map((option,i)=>{
        const {name,src}=option
        return  <div key={i.toString()} className="d-flex flex-wrap justify-content-center align-items-center">
                    <h4>{name}</h4>
                    <img
                        src={src}
                        className={classes.payment__image}
                    />
                    <input
                        type='radio'
                        name='payment_method'
                        className='form-check-input'
                        value={name}
                        checked={inputValues.payment_method===name?inputValues.payment_method:''}
                        onChange={()=>onSelect(name)}
                    />
                </div>
    })


    const handleSubmit=(event)=>{
        event.preventDefault()

        let sendBtn=document.getElementById("sendBtn")

        //client-side validation
        const errors=validate(inputValues)

        console.log("[errors]",errors)

        setValidationErrors(errors)

        if(!isObjectEmpty(errors)){
            //if any errors occur return null and do not submit the input values
            return
        }else{
            //if no errors occur then input values submit in the backend
            const{payment_method}=inputValues

            if(payment_method==="stripe"){
               return router.push({
                    pathname: '/payment/stripe',
                    query: inputValues,
                  });
            }else if(payment_method==="sslcommerz"){
                return router.push({
                    pathname: '/payment/sslcommerz',
                    query: inputValues,
                  });
            }


            //change submit button value
            sendBtn.innerHTML="Submitting.....";

            //reset form
            setInputValues({
                name:"",
                email:"",
                phone_number:"",
                address:"",
                post_code:"",

            })
        }

    }




    
  return (
    <>
        <div className="row">
            <h2 className={classes.checkout__hero__title}>CHECKOUT</h2>
            <p className={classes.checkout__hero__description}>START YOUR ORDER AND STAY WITH US</p> 
        </div>
        <div className={classes.checkout__container}>
        <AuthCard
            title='Checkout' 
            onSubmitHandler={handleSubmit}
            errors={validationErrors}
        >
            <div className="row mb-2">
                <div className="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div className="row">
                        <div className="col-lg-6 col-md-6 col-sm-12">
                        {
                            inputs.map((input)=>{
                                return (
                                    <FormInput
                                        key={input.id}
                                        {...input}
                                        value={inputValues[input.name]}
                                        className="mb-2"
                                        onChange={handleInputChange}
                                        />
                                )
                            }) 
                        }
                        </div>
                        <div className="col-lg-6 col-md-6 col-sm-12">
                        <FormTextArea
                            label="Address"
                            name='address'
                            value={inputValues.address}
                            className='mb-1'
                            rows={3}
                            placeholder="Enter Address"
                            onChange={handleInputChange}
                            errorMessage={validationErrors.address}
                        />
                                <FormSelect
                                    name="division_id"
                                    label="Division"
                                    className='mb-1'
                                    onChange={handleInputChange}
                                    errorMessage={validationErrors.division}
                                >
                                        {
                                        divisions?.data?.map((division)=>{
                                            return <SelectOptions value={division.id} option_name={division.name}/>
                                            })
                                        }
                                </FormSelect>
                                <FormSelect
                                    name="district_id"
                                    label="District"
                                    className='mb-1'
                                    onChange={handleInputChange}
                                    errorMessage={validationErrors.district}
                                >
                                    {
                                        districts?.data?.map((district)=>{
                                            return <SelectOptions value={district.id} option_name={district.name}/>
                                        })
                                    }
                                </FormSelect>
                                <FormSelect
                                    name="state_id"
                                    label="State"
                                    className='mb-1'
                                    onChange={handleInputChange}
                                    errorMessage={validationErrors.district}
                                >
                                    {
                                        states?.data?.map((state)=>{
                                            return <SelectOptions value={state.id} option_name={state.name}/>
                                        })
                                    }
                                </FormSelect>
                        </div>
                    </div>
                </div>
                <div className="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    {paymentOptionView}
                    <CartButton
                        id='sendBtn'
                        type='submit'
                    >Place Order</CartButton>
                </div>
            </div>
        {/* </div> */}
        </AuthCard>
        </div>
        
    </>
  )
}

export default Checkout

