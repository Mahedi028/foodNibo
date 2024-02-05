import React from 'react'
import classes from './submitbutton.module.css'
const SubmitButton = (props) => {
  return (
    <button
        id={props.id}
        type={props.type || 'button'}
        onClick={props.onClick}
        className={`${classes.submit__button} ${props.className}`}
        disabled={props.disabled}
    >
    {props.children}
    </button>
  )
}

export default SubmitButton