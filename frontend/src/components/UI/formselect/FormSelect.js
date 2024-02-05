import React from 'react'
import classes from  './formselect.module.css'
const FormSelect = (props) => {
    const {label,name,className,onChange,children,errorMessage}=props
  return (
    <div className={classes.select__container}>
        <label>{label}</label>
        <select
            name={name}
            className={`${classes.select} ${className}`}
            onChange={onChange}
        >
        {children}
        </select>
        {/* <span>{errorMessage}</span> */}
        <div className={classes.input__error}>{errorMessage}</div>
    </div>

  )
}


export const SelectOptions=(props)=>{
    const {value, option_name}=props
    return <option value={value}>{option_name}</option>
}

export default FormSelect
