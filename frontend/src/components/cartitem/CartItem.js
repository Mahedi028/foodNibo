import React, { useEffect } from 'react'
import classes from './cartitem.module.css'
import Image from 'next/dist/client/image'
import { useCart } from '@/hooks/cart'
import { useSession } from 'next-auth/react'
import {ImCross} from 'react-icons/im'
import CartButton from '../UI/button/CartButton'
const CartItem = ({cartItem}) => {

  console.log("[cart-props]",cartItem)

  const {removeCartItem}=useCart()

  const {id,menu_image,menu_name,quantity,unit_price,total_price}=cartItem

  useEffect(() => {

  }, [cartItem])
  



  return (
    <div className={classes.cart_container}>
        <div className={classes.cart_content}>
            <Image
                src={menu_image}
                width={100}
                height={100}
                alt='Cart-image'
            />
             <div className={classes.cart_details}>
                <h4 className={classes.cart__title}>{menu_name}</h4>
                <h5>${quantity}x{unit_price}</h5>
                <h5>${total_price}</h5>
             </div>
             <div className={classes.cart_actions}>
                  <CartButton
                      type='button'
                      onClick={()=>removeCartItem({id})}
                      >
                                {/* <span> */}
                                    {/* <AiFillDelete className={classes.cart__action__icon}/> */}
                                    <ImCross className={classes.cart__action__icon}/>
                                {/* </span> */}
                            </CartButton>
                            {/* <button><span><BsFillPlusCircleFill/></span></button> */}
                            {/* <button><span><AiFillMinusCircle/></span></button> */}
                            </div>
        </div>
    </div>
  )
}

export default CartItem