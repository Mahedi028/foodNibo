import React from 'react'
import classes from './authcard.module.css'
import AuthValidationErrors from './AuthValidationErrors'
const AuthCard = ({title, children, onSubmitHandler, errors}) => {
  return (
    <div className={`${classes.auth__card__container} `}>
        <form onSubmit={onSubmitHandler}>
            <h2 className={classes.auth__title}>{title}</h2>
            <AuthValidationErrors errors={errors}/>
            {children}
        </form>
    </div>
  )
}

export default AuthCard