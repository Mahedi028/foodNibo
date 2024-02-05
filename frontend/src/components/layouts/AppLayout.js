import React from 'react'
import NavBar from '../UI/navbar/NavBar'
import Footer from '../UI/footer/Footer'
import Head from 'next/head'
import { ToastContainer} from 'react-toastify';

const AppLayout = ({children, title='Food Nibo',session}) => {


  return (
    <>
      <Head>
        <title>{title}</title>
        <meta charSet="utf-8"/>
        <meta name='viewport' content='initial-scale=1.0, width=device-width'/>
      </Head>
      <body>
      {/* <SessionProvider session={session}> */}
        <NavBar/>
        <main className='d-flex flex-column justify-content-center align-items-center mt-2 mb-2'>
            {children}
            <ToastContainer/>
        </main>
        <Footer/>
        {/* </SessionProvider> */}

      </body>
      
    </>
  )
}

{/* export async function getServerSideProps(ctx) {
  const session = await getSession(ctx)
  return ({props: {session}})
} */}

export default AppLayout