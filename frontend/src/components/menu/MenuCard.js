import React, { useEffect, useState } from 'react'
import Image from 'next/dist/client/image'
import Link from 'next/dist/client/link'
import classes from './menucard.module.css'
import { useCart } from '@/hooks/cart'
import { toast} from 'react-toastify';
import { useAuth } from '@/hooks/auth'

const MenuCard = ({menu}) => {

    const [message, setMessage]=useState("")

    const [errors, setErrors]=useState(null)

    console.log("[errors]",errors)

    const {user}=useAuth()

    const {name,email,phone_number}=user?.data || {}

    console.log("[menu-card]",email)

    const {AddToCart}=useCart({
        authenticatedUser:email?email:"",
        redirectIfAuthenticated:"/login"
    })


    console.log("[cart-message]",message)

    const {id,title,price,description,discount_price,meal_thumbnail}=menu

    useEffect(() => {
        if(message!==""){
            toast.success(message, {
                position: toast.POSITION.TOP_CENTER,
                autoClose: 5000
            });
        }
        // if(errors){
        //     toast.error(errors,{
        //         position: toast.POSITION.TOP_CENTER,
        //         autoClose: 5000
        //     })
        // }

        
     
      
    }, [menu,AddToCart])

   
    
  return (
    <div className={classes.menu__card__container} >
                <Link href={`/menu/${id}`} className='text-decoration-none'>
                    <Image
                        src={meal_thumbnail}
                        width={0}
                        height={0}
                        sizes="100vw"
                        // style={{ width: '100%', height: 'auto' }} // optional
                    />
                </Link>
                <div className={classes.menu__card__content}>
                    <h4 className={classes.menu__card__title}>{title}</h4>
                    <p className={classes.menu__card__price}>${price}</p>
                    <button
                        onClick={()=>AddToCart({setMessage,setErrors,id,quantity:1})}
                        className={classes.menu__card__button}
                    >ADD TO CART</button>
                </div>
            </div>
  )
}

export default MenuCard