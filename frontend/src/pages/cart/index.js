import Cart from '@/components/cart/Cart'
import AppLayout from '@/components/layouts/AppLayout'
import React from 'react'
import { getSession } from 'next-auth/react'
const CartPage = () => {
  return (
    <AppLayout>
      <Cart/>
    </AppLayout>
  )
}

export default CartPage

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


  // const user=await response.json()

  return {
    props: {
      session,
      user
    }
    // props: {user}
  }
}
