import AppLayout from '@/components/layouts/AppLayout'
import ChangePassword from '@/components/profile/change-password/ChangePassword'
import React from 'react'
import { getSession } from 'next-auth/react'

const ChangePasswordPage = ({user}) => {
  return (
    <AppLayout>
      <ChangePassword userData={user}/>
    </AppLayout>
  )
}

export default ChangePasswordPage

export async function getServerSideProps(context) {

  const session = await getSession({req:context.req})

  if(!session){
    return {
      redirect:{
        destination:'/login',
        permanent:false
      }
    }
  }
  const token=session?.user?.userData?.token

  const res = await fetch("http://127.0.0.1:8000/api/v1/user", {
    method: 'GET',
    headers: {
      'Content-Type': "application/json; charset=utf-8",
      Authorization: `Bearer ${token}`
    },
    credentials: 'include',
    withCredentials: true,
  })

  const user = await res?.json()

  console.log("[response]",user)

  return {
    props: {
      session,
      user
    }
    // props: {user}
  }
}