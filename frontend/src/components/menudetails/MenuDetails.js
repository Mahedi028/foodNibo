import React, { useEffect, useState } from 'react'
import classes from './menudetails.module.css'
import Image from 'next/dist/client/image'
import FormSelect, {SelectOptions} from '../UI/formselect/FormSelect'
import CartButton from '../UI/button/CartButton'
import Bedge from '../UI/bedge/Bedge'
import { useCart } from '@/hooks/cart'
import CartItem from '../cartitem/CartItem'
const MenuDetails = ({menu}) => {



    const [quantity,setQuantity]=useState(1)

    const[message,setMessage]=useState("")
    const[errors,setErrors]=useState("")

    const {cart, AddToCart}=useCart()

    console.log("[cart-page]",)

    const cartItems=cart?.data || []

    const{id,title,discount_price,price,meal_thumbnail,meal_img1,meal_img2,meal_img3,active,in_stock,ingredients,dietary_info}=menu

    const allIngredients= typeof ingredients === 'string' ? ingredients.split(",") : '';
    const allDietaryInfos= typeof dietary_info === 'string' ? dietary_info.split(",") : '';

    useEffect(() => {
        if(message!==""){
            toast.success(message, {
                position: toast.POSITION.TOP_CENTER,
                autoClose: 5000
            });
        }
      
    }, [menu])


    const handleIncrement=()=>{
        if(quantity>=1){
            setQuantity(quantity+1)
        }
    }
    const handleDecrement=()=>{
        if(quantity<=1){
            setQuantity(quantity=1)
        }else{
            setQuantity(quantity-1)

        }
    }
    

  return (
    <>
        <div className="d-flex justify-content-center align-items-center">
            <h2 className={classes.menu__hero__title}>{title}</h2>
            <p className={classes.menu__hero__description}>MENU CATEGOR</p>
        </div>
        <div className={classes.menu__details__container}>
            <div className="row">
                <div className="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <Image
                        src={meal_thumbnail}
                        width={490}
                        height={450}
                        objectFit='cover'
                        className={classes.main__image}
                    />
                    <div className="row">
                        <div className="col-lg-4 col-md-4 col-sm-12">
                            <Image
                                src={meal_img1}
                                width={150}
                                height={150}
                                className={classes.sub__image1}
                            />
                        </div>
                        <div className="col-lg-4 col-md-4 col-sm-12">
                            <Image
                                src={meal_img2}
                                width={150}
                                height={150}
                                className={classes.sub__image1}
                            />
                        </div>
                        <div className="col-lg-4 col-md-4 col-sm-12">
                            <Image
                                src={meal_img3}
                                width={150}
                                height={150}
                                className={classes.sub__image1}
                            />
                        </div>
                    </div>
                </div>
                <div className="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div className={classes.menu__details__des}>
                        <h2 className={`text-center mt-3 ${classes.menu__title}`}>{title}</h2>
                        <h6 className={`text-center mt-3 ${classes.menu__price}`}>Price ${price}</h6>
                    </div>
                    <div className="d-flex flex-column">
                        <div className={classes.roundInput}>
                            <button
                                type='button'
                                onClick={handleIncrement}
                            >+</button>
                            <input
                                type='number'
                                name='quantity'
                                value={quantity}
                                onChange={()=>setQuantity(quantity)}
                            />
                            <button
                                type='button'
                                onClick={handleDecrement}
                            >-</button>
                        </div>
                        <CartButton
                            onClick={()=>AddToCart({setMessage,setErrors,id,quantity})}
                        >
                            ADD TO BUTTON
                        </CartButton>
                    </div>
                    <hr/>
                    <div className="mt-2">
                        <h4>Ingredients</h4>
                       {
                        allIngredients && allIngredients.length > 0 ?
                        allIngredients.map(text=><Bedge text={text} backgroundColor="crimson" color="white"/>):null
                       }
                       <hr/>
                       <h4>Dietary Info</h4>
                       {
                        allDietaryInfos && allDietaryInfos.length > 0 ?
                        allDietaryInfos.map(text=><Bedge text={text} backgroundColor="crimson" color="white"/>):null
                       }
                    </div>
                </div>
                <div className="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        {
                            cartItems && cartItems.map((cartItem)=>{
                                return (<CartItem cartItem={cartItem}/>)
                                    })
                                    }
                </div>
            </div>
        </div>
    </>
  )
}

export default MenuDetails