import React from 'react'
import classes from './singupwithgoogle.module.css'
import {FcGoogle} from 'react-icons/fc'
const SignUpWithGoogle = (props) => {
  return (
    <button
      id={props.id}
      type={props.type || 'button'}
      onClick={props.onClick}
      className={`${classes.sign__in__button} ${props.className}`}
      disabled={props.disabled}
    >
    <FcGoogle className={classes.button__icon}/>{props.children}
    </button>
  )
}

export default SignUpWithGoogle