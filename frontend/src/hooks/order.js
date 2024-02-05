import useSWR from "swr";
import HttpService from "@/lib/HttpService";
import { useAuth } from "./auth";
export const useOrder=()=>{

    const {user}=useAuth()

    const {id}=user?.data || {}

    const { data: orders, error, revalidate } = useSWR(`/api/v1/${id}/orders`, () =>
    HttpService
        .get(`/api/v1/${id}/orders`)
        .then((res) => {
            console.log("[user-order]",res.data)
            return res?.data?.data
        })
        .catch(error => {
            if (error.response.status != 409) throw error
        }),
)
    

       

        return {
            orders,
            error
        }


}