import React, { useEffect, useState } from 'react'
import { useRouter } from 'next/router'
import useSWR from 'swr'
import HttpService from '@/lib/HttpService'

const EmailVerificationPage = () => {

  //define navigate pages after activate account
  const router=useRouter()
  //get token form url
  const token=router?.query?.token
  //define state
  const [activeAccountStatus,setActiveAccountStatus]=useState(false)
  const [message, setMessage]=useState("")



 useEffect(() => {

  
 }, [token])

 const fetchActiveStatus=()=>{
  HttpService.get(`/api/v1/active/${token}`)
             .then((res)=>{
              let StatusCode=res.status;
              if(StatusCode===200){
                console.log("[response]",res.data)
                //change active activation status
                setActiveAccountStatus(res?.data?.account_active_status);
                setMessage(res.data.message)
              }
             })

             .catch((error)=>{
              console.log("[error]",error)
              
             })
}

const{data:active_account_status}=useSWR(`/api/active/${token}`,fetchActiveStatus)

console.log("[verify]",active_account_status)


  if(activeAccountStatus===true){
    HttpService.put(`/api/v1/updatetoken/${token}`)
              .then((res)=>{
                let StatusCode=res.status;
                if(StatusCode===200){
                  console.log("[response-verify]",res.data)
                  //change active activation status
                  setActiveAccountStatus(res?.data?.account_active_status);
                  setMessage(res.data.message)
                  return router.push('/login')

                }
              }) 
  }


  if(!activeAccountStatus){
    return(
      <div>Loading..........................................</div>
    )
  }
  
  return null
}

export default EmailVerificationPage