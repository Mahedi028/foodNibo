import React, { useEffect, useState } from 'react'
import classes from './stripe.module.css'
import { CardCvcElement, CardElement, CardExpiryElement, CardNumberElement, Elements, PaymentElement, useElements, useStripe } from '@stripe/react-stripe-js'
import {loadStripe} from '@stripe/stripe-js';
import AuthCard from '@/components/auth/AuthCard';
import { usePayment } from '@/hooks/payment';
import { useAuth } from '@/hooks/auth';
import { useCart } from '@/hooks/cart';


// Make sure to call `loadStripe` outside of a component's render to avoid
// recreating the `Stripe` object on every render.
const stripePromise = loadStripe('pk_test_51MxMYHG38ZhpEoQxxoqqWmE4cekOsunY9zR03bfLDKJvAVnjkLY003pFGO8fD6D63qfc25qrbLqupM6W16mIXQAu002MZZnw6J');




const PaymentFrom=({checkout})=>{

    const{name,phone,address,post_code,payment_method,district_id,division_id,state_id}=checkout

    const {user}=useAuth()
    const {id,email}=user?.data || {}

    const {cart}=useCart()

    const cartItems=cart?.data || []

    const cartTotal=cartItems.reduce((sum,curr)=>sum+parseInt(curr.total_price),10)


    const [paymentError,setPaymentError]=useState(null)
    const [errors, setErrors]=useState(null)

    const {StripePostOrder}=usePayment()

    const cardElementOptions = {

        //card elements options properties
        //1.classes     use=Set custom class names on the container DOM element type=[object]
        //2.style       use=Customize the appearance of this element using CSS properties passed type=[object]
        //3.placeholder use=Customize the placeholder text. type=[string] value=[any text]
        //4.disabled    use=Applies a disabled state to the Element such that user input is not accepted type=[boolean] [default=false]
        //5.showIcon    use=Show a card brand icon in the Element type=[boolean] value=[true,false] [default=false]
        //6.iconStyle   use=Appearance of the icon in the Element  type=[string] value=[solid,default]


        //style object properties
        //1.base        use=all other variants inherit from these styles type=[object]
        //2.complete    use=applied when the Element has valid input type=[string]
        //3.empty       use=applied when the Element has no customer input type=[sting]
        //4.invalid     use=applied when the Element has invalid input

        
        style: {
          base: {
            iconColor: 'crimson',
            color: "#666",
            fontSize: "20px",
          },
          invalid: {
            color: "#fa755a",
            fontSize: "20px",
          },
          //complete:'',type=string   use=The class name to apply when the Element is complete
          //empty:'', type=string     use=The class name to apply when the Element is empty
          //focus:'', type=string     use=The class name to apply when the Element is focused



        },
        //this property effect for payment icon (true || false)
        showIcon:true,
        //this property effects for styling an icon (solid || default)
        iconStyle:'solid',
        //this property Customize the placeholder text.
        // placeholder:'Enter Card information'

      }


      useEffect(() => {
        
      }, [checkout])
      
   


    const stripe=useStripe()
    const elements=useElements()

    async function stripeTokenHandler(token){
        const paymentData={token:token.id}

        const stripeToken=paymentData.token

        console.log("[stripe-token]",stripeToken)

        StripePostOrder({
            setErrors,
            stripeToken,
            user_id:id,
            name,
            email,
            phone,
            address,
            post_code,
            payment_method,
            division_id,
            district_id,
            state_id,
            total_amount:cartTotal
        });
    }




    const handleSubmit= async(event)=>{
        event.preventDefault();

        if(!stripe || !elements){
            return 
        }

        //get card information
        const card=elements.getElement(CardCvcElement,CardExpiryElement,CardNumberElement)
        console.log("[card]",card)

        const result=await stripe.createToken(card);
        console.log("[card-result]",result)

        if(result?.error){
            //show error to your customer
            console.log("[card-error]",result.error?.charge?.message)
            //set errors in the app state
            setPaymentError(result.error?.charge?.message)
        }else{
            //send the token to your server
            //this function does not exist yt; we will define it in the next step
            stripeTokenHandler(result?.token)
        }
    };


    return (
        <div className={classes.form_container}>
                <AuthCard
                    onSubmitHandler={handleSubmit}
                    errors={paymentError}
                >
                <div className="row mb-2">
                    <div className="col-lg-12 col-md-12 col-sm-12">
                        <label htmlFor="cardNumber">Card Number</label>
                        <CardNumberElement options={cardElementOptions}/>
                    </div>
                </div>
                <div className="row mb-2">
                    <div className="col-lg-6 col-md-6 col-sm-12">
                        <label htmlFor="cvc">Card Verification Code</label>
                        <CardCvcElement options={cardElementOptions}/>
                    </div>
                    <div className="col-lg-6 col-md-6 col-sm-12">
                        <label htmlFor="expiry">Card Expiration</label>
                        <CardExpiryElement options={cardElementOptions}/>
                    </div>
                </div>
                    <button disabled={!stripe}>Confirm order</button>
            </AuthCard>
                {
                paymentError && (<p className='text-danger'>{paymentError}</p>)
                }
        </div>
    )
}

const StripePayment = ({checkout}) => {

    console.log("[checkout-details]",checkout)

    const appearance = {
        theme: 'dark',
        labels: 'floating',
        variables: {
            colorPrimary: '#0570de',
            colorBackground: '#ffffff',
            colorText: '#30313d',
            colorDanger: '#df1b41',
            fontFamily: 'Ideal Sans, system-ui, sans-serif',
            spacingUnit: '2px',
            borderRadius: '4px',
            fontSizeBase:'16px',
            colorLogo:'dark'
            // See all possible variables below
        }

    };

    const options = {
        appearance,
    };


    useEffect(() => {
      
    }, [checkout])
    

  return (
    <div className={classes.checkout__container}>
        <div className="row">
            <div className="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div>
                    <h5 className='text-center'>Payment Details</h5>
                </div>
                <Elements stripe={stripePromise} options={options}> 
                    <PaymentFrom checkout={checkout}/>
                </Elements>
            </div>
            <div className="col-lg-5 col-md-5 col-sm-12 col-xs-12">
               
            </div>
        </div>
    </div>
  )
}



export default StripePayment