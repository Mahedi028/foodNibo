import HttpService from '@/lib/HttpService'
import { useRouter } from 'next/router'
import React, { useEffect } from 'react'
import { signIn,useSession } from "next-auth/react"
import AppLayout from '@/components/layouts/AppLayout'

const GoogleSignIn = () => {

  const router=useRouter()
  const {data:session}=useSession()


  // console.log("[router]",router)
  //get callback url
  const code=router?.query['code']
  const scope=router?.query['scope']
  const authUser=router?.query['authuser']
  console.log("[authuser]",authUser)
  const prompt=router?.query['prompt']
  // const callbackUrl=router?.query['scope']
  const param=router?.query
  console.log("[object]",param)

 

  


  
  // console.log("[callback]",callbackUrl)
  // console.log("[param]",param)
  // console.log("[location]",location)


  useEffect(async() => {

    if(router?.query){
      const url=`/api/v1/login/google/callback?code=${code}&scope=${scope}&authuser=${authUser}&prompt=${prompt}`

      console.log("[url]",url)

      const result= await signIn('credentials',{
        redirect:false,
        _callbackUrl: `${window.location.origin}`,
        googleCallbackUrl:url
      });

      if(result?.error){
        console.log("[error-auth]",result?.error)
      }
     
    }
   
  }, [router?.query])

  if(session && session?.user){
    router.push('/')
  }

  return (
    <AppLayout>
      <div className="load"></div>
    </AppLayout>
  )

  return null
}

export default GoogleSignIn