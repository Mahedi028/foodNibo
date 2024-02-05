import useSWR from 'swr'
import HttpService from '@/lib/HttpService'
import { useEffect } from 'react'
import { useRouter } from 'next/router'
import { useAuth } from './auth'
import { toast} from 'react-toastify';


export const useCart = ({ authenticatedUser, redirectIfAuthenticated } = {}) => {

    const router = useRouter()
    
    const {user}=useAuth()

    const {name,email,phone_number}=user?.data || {}

    const { data: cart, error, revalidate } = useSWR(`/api/v1/cartlist/${email}`, () =>
        HttpService
            .get(`/api/v1/cartlist/${email}`)
            .then((res) => {
                console.log("[cart]",res.data)
                return res.data
            })
            .catch(error => {
                if (error.response.status != 409) throw error

                router.push('/login')
            }),
    )
   

    const csrf = () => HttpService.get('/sanctum/csrf-cookie')

    // const AddToCart = async ({ setErrors, ...props }) => {
    const AddToCart = async ({setMessage,setErrors,id,quantity}) => {
        await csrf()

        setErrors([])
        setMessage("")

        HttpService
            .post('/api/v1/addtocart', {id,email,quantity})
            .then((response) => {
                console.log("[post-cart-data]",response?.data)
                setMessage(response?.data?.message)
                
                revalidate()
                if(response?.data){
                    router.push('/cart')
                }

            })
            .catch(error => {
                
                console.log("[error]",error)
                if (error.response?.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    

    const removeCartItem = async ({setMessage,setErrors,id}) => {
        await csrf()

        // setStatus(null)
        // setErrors([])
        setErrors([])
        setMessage("")

        HttpService
            .delete(`/api/v1/removecartlist/${id}`)
            .then((res) => {
                revalidate()
                console.log("[delete]",res.data)
                setMessage(res.data.message)

            })
            .catch(error => {
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    const incrementCartItem = async ({ setErrors, setStatus, email }) => {
        await csrf()

        setStatus(null)
        setErrors([])

        HttpService
            .post('/forgot-password', { email })
            .then(response => setStatus(response.data.status))
            .catch(error => {
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    const decrementCartItem = async ({ setErrors, setStatus, ...props }) => {
        await csrf()

        setStatus(null)
        setErrors([])

        HttpService
            .post('/reset-password', { token: router.query.token, ...props })
            .then(response => router.push('/login?reset=' + btoa(response.data.status)))
            .catch(error => {
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }


    useEffect(() => {

        // if(authenticatedUser===email && authenticatedUser!=="") AddToCart
        // if(authenticatedUser!==email && redirectIfAuthenticated)router.push(redirectIfAuthenticated)

        // authenticatedUser!==email && redirectIfAuthenticated!==''?AddToCart:router.push(redirectIfAuthenticated)
        // authenticatedUser!==email && redirectIfAuthenticated!==''?removeCartItem:router.push(redirectIfAuthenticated)
    
    }, [cart,error])

    return {
        cart,
        AddToCart,
        removeCartItem,
        incrementCartItem,
        decrementCartItem,
    }
}
