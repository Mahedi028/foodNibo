import useSWR from 'swr'
import HttpService from '@/lib/HttpService'
import { useEffect } from 'react'
import { useRouter } from 'next/router'
import { useSession } from 'next-auth/react'
import { useAuth } from './auth'

export const useCheckout = ({division_id,district_id}) => {

    const router = useRouter()
    
    const {user}=useAuth()

    const {name,email,phone_number}=user?.data || {}

    const { data: divisions} = useSWR(`/api/v1/alldivitions`, () =>
        HttpService
            .get(`/api/v1/alldivitions`)
            .then((res) => {
                console.log("[divisions]",res.data)
                return res.data
            })
            .catch(error => {
                if (error.response.status != 409) throw error

                router.push('/login')
            }),
    )

    const { data: districts} = useSWR(`/api/v1/district-get/${division_id}`, () =>
        HttpService
            .get(`/api/v1/district-get/${division_id}`)
            .then((res) => {
                console.log("[districts]",res.data)
                return res.data
            })
            .catch(error => {
                if (error.response.status != 409) throw error

                router.push('/login')
            }),
    )

    const { data: states} = useSWR(`/api/v1/state-get/${district_id}`, () =>
        HttpService
            .get(`/api/v1/state-get/${district_id}`)
            .then((res) => {
                console.log("[states]",res.data)
                return res.data
            })
            .catch(error => {
                if (error.response.status != 409) throw error

                router.push('/login')
            }),
    )
   

    const csrf = () => HttpService.get('/sanctum/csrf-cookie')

    // const AddToCart = async ({ setErrors, ...props }) => {
    const AddToCart = async ({id,quantity}) => {
        await csrf()

        // setErrors([])



        HttpService
            .post('/api/v1/addtocart', {id,email,quantity})
            .then((response) => {
                console.log("[post-cart-data]",response?.data)
                revalidate()
                if(response?.data){
                    router.push('/cart')
                }
            })
            .catch(error => {
                console.log("[error]",error)
                if (error.response?.status != 422) throw error

                // setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    

    const removeCartItem = async ({id}) => {
        await csrf()

        // setStatus(null)
        // setErrors([])

        HttpService
            .delete(`/api/v1/removecartlist/${id}`)
            .then(() => revalidate())
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
        if(user) AddToCart

    // }, [cart, user])
    // }, [cart])
    }, [divisions,user])

    return {
        divisions,
        districts,
        states,
        AddToCart,
        removeCartItem,
        incrementCartItem,
        decrementCartItem,
    }
}
