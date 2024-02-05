import React from 'react'
import classes from './forminput.module.css'
const FormInput = (props) => {
    const {name,value,type,className,placeholder,onChange,pattern,label,errorMessage}=props
  return (
    <div className={classes.input__container}>
        <label htmlFor={name}>{label}</label>
        <input
            name={name}
            value={value}
            type={type}
            className={`${classes.input} ${className}`}
            placeholder={placeholder}
            onChange={onChange}
            pattern={pattern}
            // required={props.required}
            // onBlur={handleFocus}
            // onFocus={()=>props.name==="password_confirmation" && setFocused(true)}
            // focused={focused.toString()}
        />
    </div>
  )


}



export default FormInput
