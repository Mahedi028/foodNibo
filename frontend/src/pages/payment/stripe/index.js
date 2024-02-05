import AppLayout from '@/components/layouts/AppLayout'
import StripePayment from '@/components/payment/stripe/StripePayment'
import { useRouter } from 'next/router'
import React, { useEffect } from 'react'

const StripePage = () => {

  const router=useRouter()

  useEffect(() => {
   
  }, [router?.query])
  

  return (
    <AppLayout>
        <StripePayment checkout={router?.query}/>
    </AppLayout>
  )
}

export default StripePage