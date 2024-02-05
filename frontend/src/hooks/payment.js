import { useRouter } from "next/router";
import useSWR from "swr";
import HttpService from "@/lib/HttpService";

export const usePayment=()=>{

    const router=useRouter()


        const csrf = () => HttpService.get('/sanctum/csrf-cookie')

        const StripePostOrder = async ({setErrors, ...props}) => {
            await csrf()
    
            setErrors([])

            console.log("[information]",props)
    
            HttpService
                .post('/api/v1/stripe/order', {...props})
                .then((response) => {
                    console.log("[post-order-data]",response?.data)
                    // revalidate()
                    if(response?.data){
                        router.push('/profile/user/orders')
                    }
                })
                .catch(error => {
                    console.log("[error]",error)
                    if (error.response?.status != 422) throw error
    
                    // setErrors(Object.values(error.response.data.errors).flat())
                })
        }

        return {
            StripePostOrder,
        }


}