import useSWR from 'swr'
import HttpService from '@/lib/HttpService'
import { useEffect } from 'react'
import { useRouter } from 'next/router'

export const useAuth = ({ middleware, redirectIfAuthenticated } = {}) => {
    const router = useRouter()

    const { data: user, error, revalidate } = useSWR('/api/user', async() =>
        await HttpService
            .get('/api/v1/user')
            .then((res) => {
                console.log("[user]",res.data)
                return res.data
            })
            .catch(error => {
                if (error.response.status != 409) throw error

                router.push('/verify-email')
            }),
    )
   
   

    const csrf = () => HttpService.get('/sanctum/csrf-cookie')

    const register = async ({ setErrors, ...props }) => {
        await csrf()

        setErrors([])

        HttpService
            .post('/api/v1/register', props)
            .then((response) => {
                console.log("[data]",response.data)
                revalidate()
                if(response?.data?.user){
                    router.push('/login')
                }
            })
            .catch(error => {
                console.log("[error]",error)
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    

    const login = async ({ setErrors, setStatus, ...props }) => {
        await csrf()

        setStatus(null)
        setErrors([])

        HttpService
            .post('/api/v1/login', props)
            .then(() => revalidate())
            .catch(error => {
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }

    const forgotPassword = async ({ setErrors, setStatus, email }) => {
        await csrf()

        // setStatus(null)
        setErrors([])

        HttpService
            .post('/api/v1/forgetpassword', { email })
            .then((response) => {
                console.log("[forget-response]",response.data)
            })
            .catch(error => {
                if (error.response.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }
    const updateProfile = async ({ setErrors, setStatus, id,name,email,phone_number}) => {
        await csrf()

        setStatus(null)
        setErrors([])

        HttpService
            .put(`/api/v1/user/${id}/edit`, { name,email,phone_number })
            .then((response) => {
                console.log("[update-response]",response?.data?.data)
                setStatus(response?.data?.data)
            })
            .catch(error => {
                if (error?.response?.status != 422) throw error

                setErrors(Object.values(error.response.data.errors).flat())
            })
    }
    const updateSession = async ({ setErrors, setStatus}) => {
        await csrf()

        setStatus(null)
        setErrors([])

        await fetch("http://localhost:3000/api/auth/session?update",{
            method:"GET",
            headers:{
                'Content-Type': "application/json; charset=utf-8",
            }
        })
        .then((res)=>{
            console.log("[update-session]",res.json())
        })
        .catch((error)=>{
            console.log("[error]",error)
        })
    }

    const resetPassword = async ({ setErrors, setStatus, ...props }) => {
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

    const resendEmailVerification = ({ setStatus }) => {
        HttpService
            .post('/email/verification-notification')
            .then(response => setStatus(response.data.status))
    }

    const logout = async () => {
        if (! error) {
            await HttpService.post('/logout')
            revalidate()
        }

        window.location.pathname = '/login'
    }

    useEffect(() => {
        if (middleware == 'guest' && redirectIfAuthenticated && user) router.push(redirectIfAuthenticated)
        if (middleware == 'auth' && error) logout()
    }, [user, error])

    return {
        user,
        register,
        login,
        forgotPassword,
        resetPassword,
        resendEmailVerification,
        updateProfile,
        updateSession,
        logout,
    }
}
