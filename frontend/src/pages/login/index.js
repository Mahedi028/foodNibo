import AppLayout from '@/components/layouts/AppLayout'
import LoginFrom from '@/components/login/LoginFrom'
import React from 'react'
import { getCsrfToken } from 'next-auth/react'
// const LoginPage = ({csrfToken}) => {
const LoginPage = () => {
  // console.log("[csrfToken]",csrfToken)
  return (
      <AppLayout>
        {/* <LoginFrom csrfToken={csrfToken}/> */}
        <LoginFrom/>
      </AppLayout>
  )
}

// export async function getServerSideProps(context) {
//   const csrfToken = await getCsrfToken(context)
//   return {
//     props: { 
//       csrfToken:csrfToken
//     },
//   }
// }



export default LoginPage