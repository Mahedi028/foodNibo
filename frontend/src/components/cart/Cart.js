import React, { useState,useEffect } from 'react'
import classes from './cart.module.css'
import { useCart } from '@/hooks/cart'
import FormSelect, {SelectOptions} from '../UI/formselect/FormSelect'
import CartButton from '../UI/button/CartButton'
import {AiFillDelete} from 'react-icons/ai'
import FormInput from '../UI/Input/FormInput'
import Link from 'next/dist/client/link'
import { toast} from 'react-toastify';
import { useAuth } from '@/hooks/auth'

const Cart = () => {

    const [message,setMessage]=useState("")
    const [errors,setErrors]=useState([])

    const {user}=useAuth()
    const {name,email,phone_number}=user?.data || {}


    const {cart, removeCartItem}=useCart({
        authenticatedUser:email?email:"",
        redirectIfAuthenticated:"/login"
    })

    console.log("[cart-page]",message)

    const cartItems=cart?.data || []


    useEffect(() => {
        if(message!==""){
            toast.success(message, {
                position: toast.POSITION.TOP_CENTER,
                autoClose: 15000
            });
        }
    }, [removeCartItem])
    


  return (
    <>
        <div className="row">
            <h2 className={classes.cart__hero__title}>YOUR SHOPPING CART</h2>
            <p className={classes.cart__hero__description}>START YOUR ORDER AND STAY WITH US</p>
        </div>
        <div className={classes.cart__container}>
            <div className="row">
                <div className="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div className={classes.order__table__container}>
                        <table>
                            <thead>
                                <tr>
                                    <th className='text-center'>Menu Name</th>
                                    <th className='text-center'>Image</th>
                                    <th className='text-center'>Quantity</th>
                                    <th className='text-center'>Price</th>
                                    <th className='text-center'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                cartItems?cartItems.map((cartItem)=>{
                                    const {id,menu_name,menu_image,total_price,quantity}=cartItem || {}
                                    return (
                                        <tr key={id.toString()} style={{background:'crimson', marginBottom:10}}>
                                            <td className={classes.menu__name}>{menu_name}</td>
                                            <td className='d-flex justify-content-center align-items-center'>
                                                <img
                                                    src={menu_image}
                                                    className={classes.cart__image}
                                                />
                                            </td>
                                            <td>
                                                <FormSelect
                                                    name="quantity"
                                                    label="Quantity"
                                                    className='mb-1'
                                                    // onChange={handleInputChange}
                                                    // errorMessage={validationErrors.district}
                                                >
                                                <SelectOptions value={quantity.toString()=="1"?'selected':''} option_name="1"/>
                                                <SelectOptions value={quantity.toString()=="2"?'selected':''} option_name="2"/>
                                                <SelectOptions value={quantity.toString()=="3"?'selected':''} option_name="3"/>
                                                <SelectOptions value={quantity.toString()=="4"?'selected':''} option_name="4"/>
                                                </FormSelect>
                                            </td>
                                            <td className={classes.total__price}>${total_price}</td>
                                            <td>
                                                <CartButton
                                                    onClick={()=>removeCartItem({setMessage,setErrors,id})}
                                                >
                                                    <AiFillDelete className={classes.cart__action}/>
                                                </CartButton>
                                            </td>
                                        </tr>
                                    )
                                }):<div><h2>No items in Cart</h2></div>
                                }
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                    <div className={classes.coupon__container}>
                        <h4>Coupon Name</h4>
                        <FormInput/>
                        <button>ADD COUPON</button>
                    </div>
                    <hr/>
                    <div className="d-flex justify-content-center">
                        <Link href='/checkout'>
                            <CartButton>PROCEED TO CHECKOUT</CartButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </>
  )
}

export default Cart