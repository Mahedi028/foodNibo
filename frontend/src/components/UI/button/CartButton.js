import React from 'react'
import classes from './cartbutton.module.css'
const CartButton = (props) => {
  return (
    <button
        id={props.id}
        type={props.type || 'button'}
        onClick={props.onClick}
        className={`${classes.cart__button} ${props.className}`}
        disabled={props.disabled}
    >
    {props.children}
    </button>
  )
}

export default CartButton