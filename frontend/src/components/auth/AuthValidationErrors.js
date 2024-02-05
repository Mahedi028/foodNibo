import React from 'react'

const AuthValidationErrors = ({errors}) => {

    return(
        <>
            {
                errors?Object.values(errors).map((error)=>{
                return(
                    <div>
                        <ul>
                            <li className="mt-3 list-disc list-inside text-sm text-red-600">{error}</li>
                        </ul>
                    </div>
                )}):null
            }
        </>
    )
    
}

export default AuthValidationErrors