
export const validate=(inputValues)=>{
    const errors={};
    const nameRegex= /^[A-Za-z0-9]{3,16}$/;
    const emailRegex= /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
    const passwordRegex= /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i;
  
  
    if(!inputValues.name){
      errors.name="Username is required";
    }else if(!nameRegex.test(inputValues.username)){
      errors.name="Username should be 3-16 characters and shouldn't include any special character"
    }
    if(!inputValues.email){
        errors.email="Email is required";
    }else if(!emailRegex.test(inputValues.email)){
        errors.email="It should be a valid email address";
    }
  
    if(!inputValues.password){
        errors.password="Password is required";
    }else if(inputValues.password.length < 4){
        errors.password="Password must be more than 4 characters";
    }else if(inputValues.password.length > 15){
        errors.password="Password cannot exceed more than 10 characters";
    }else if(!passwordRegex.test(inputValues.password)){
        errors.password="Password should be 8-20 characters and include at least 1 letter, 1 number and 1 special character"
    }
    
    if(inputValues.password_confirmation!=inputValues.password){
      errors.password_confirmation="Password do not matched"
    }
    if(!inputValues.phone_number){
      errors.phone_number="Phone Number is required"
    }


  
    return errors
  }