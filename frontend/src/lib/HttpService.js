import Axios from 'axios'
import { getSession } from 'next-auth/react'

class HttpService{

    static api=()=>{
        //create instance of axios
        const api = Axios.create({
            //setup baseURL:localhost:8000
            baseURL: process.env.NEXT_PUBLIC_BACKEND_URL,
            //setup headers
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            },
            withCredentials: true,
        })

        //setup api response header
        api.interceptors.response.use(
            (response)=>response,
            (error)=>{
                console.log("[error]",error)
                // if(error.response.status==401){
                //     console.log("You are not logged in");
                // }
            }
        );

        //setup request header
        api.interceptors.request.use(async(config)=>{

            //get session
            const session = await getSession()

            //extract api resource token from session
            const token=session?.user?.userData?.token

            //if token exists then set request header authorization config
            if (token) {
                config.headers.common = {
                    Authorization: `Bearer ${token}`
                }
            }
            return config;
            
        });

        return api;

    }


    static get= async(url,config={})=>{
        const api=this.api();
        return await api.get(url);
    }

    static post= async(url, data)=>{
        const api=this.api();
        return await api.post(url,data);
    }

    static put= async(url, data)=>{
        const api=this.api();
        return await api.put(url,data);
    }


    static delete= async(url)=>{
        const api=this.api();
        return await api.delete(url);
    }
}



export default HttpService
