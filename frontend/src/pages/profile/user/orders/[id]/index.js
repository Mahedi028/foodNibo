import React from 'react'
import { getSession } from 'next-auth/react'
import AppLayout from '@/components/layouts/AppLayout'
import OrderDetails from '@/components/profile/orderDetails/OrderDetails'

const OrderDetailsPage = ({order, orderItems}) => {

    console.log("[order]",order)
  return (
    <AppLayout>
        <OrderDetails order={order} orderItems={orderItems}/>
    </AppLayout>
  )
}

export default OrderDetailsPage

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


  //get order data

  const { params }=context

  const orderId=params?.id

  console.log("[id]",orderId)

  const OrderRes = await fetch(`http://127.0.0.1:8000/api/v1/${orderId}/order_details`, {
    method: 'GET',
    headers: {
      'Content-Type': "application/json; charset=utf-8",
      Authorization: `Bearer ${token}`
    },
    credentials: 'include',
    withCredentials: true,
  })

  const order = await OrderRes?.json()

  console.log("[order]",order?.orderItems)





  return {
    props: {
      user,
      order:order?.order,
      orderItems:order?.orderItems
    }
  }
}



