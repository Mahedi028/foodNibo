import React from 'react'
import classes from './textarea.module.css'
const FormTextArea = (props) => {
    const {label,name,rows,value,className,placeholder,onChange,errorMessage}=props
  return (
    <div className={classes.textarea__container}>
        <label>{label}</label>
        <textarea
            name={name}
            rows={rows}
            className={`${classes.select} ${className}`}
            placeholder={placeholder}
            onChange={onChange}
        >{value}</textarea>
        {/* <span>{props.errorMessage}</span> */}
        <div className={classes.input__error}>{errorMessage}</div>
    </div>
  )
}

export default FormTextArea
