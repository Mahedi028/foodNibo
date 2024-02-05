import 'tailwindcss/tailwind.css'
import './global.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'react-toastify/dist/ReactToastify.css';
import { SessionProvider} from 'next-auth/react'

export default function App({
    Component,
    pageProps: { session, ...pageProps },
  }) {
    return (
      <SessionProvider session={session}>
        <Component {...pageProps} />
      </SessionProvider>
    )
  }
  
  