import HttpService from "@/lib/HttpService"
import NextAuth from "next-auth"
import CredentialsProvider from "next-auth/providers/credentials"

export default async function auth(req,res){
  const providers=[
    CredentialsProvider({
      // The name to display on the sign in form (e.g. 'Sign in with...')
      name: 'Credentials',
      async authorize(credentials,req,res) {

        //show user credentials
        console.log("[credentials]",credentials)
        
        if(credentials && credentials.googleCallbackUrl){
          //define google callback url
          const url=credentials?.callbackUrl.replace("http://localhost:3000","http://127.0.0.1:8000/api/v1")
          //get laravel csrf token
          await csrf()
          //send login request to backend url:http://127.0.0.1:8000/api/v1/login
          const response = await fetch(url, {
                method: 'GET',
                headers: {"Content-Type": "application/x-www-form-urlencoded",},
                credentials: 'include',
                withCredentials: true,
              });
          //if response is not ok then show error
          if(!response.ok){
            throw new Error('Something went wroung')
          }    

          //extract user from response    
          const user=await response?.json()
          
          console.log("[user-google]",user)
          //if response is ok and find user then return user to authorize()
          if(response.ok && user){

            //return user send response this format
            return {
              status: 'success', 
              userData: user
            }
          }
        }
        
        //get laravel csrf token
        await csrf()
        //send login request to backend url:http://127.0.0.1:8000/api/v1/login
        const response = await fetch("http://127.0.0.1:8000/api/v1/login", {
          method: 'POST',
          body: JSON.stringify(credentials),
          headers: {"Content-Type": "application/json",},
          credentials: 'include',
          withCredentials: true,
        })
        //if response is not ok then show error
        if(!response.ok){
          throw new Error('Something went wroung')
        }    
        //extract user from response    
        const user=await response?.json()
        
        
        //if response is ok and find user then return user to authorize()
        if (response.ok && user) {

          console.log("[api-user]",user?.token)
          //send response this format
          return {
            status: 'success', 
            userData: user
          }
        }
        
        // Return null if user data could not be retrieved
        return null
      }
      
    })
  ]


  const isDefaultSigninPage = req.method === "GET" && req.query.nextauth.includes("signin")

  // Will hide the `GoogleProvider` when you visit `/api/auth/signin`
  if (isDefaultSigninPage) providers.pop()


  return await NextAuth(req,res,{
    secret: process.env.AUTH_SECRET,
    providers,
    callbacks:{
      async jwt({token, user}){
        const user_id=token?.user?.userData?.user?.id;
        const apiToken=token?.user?.userData?.token;

        //update session when user in updated
        if(req?.url?.includes("/api/auth/session?update")){
          await csrf()

          const response=await fetch(`http://127.0.0.1:8000/api/v1/profile/${user_id}/user`, {
            method: 'GET',
            headers: {
              Accept: 'application/json; charset=UTF-8',
              Authorization:`Bearer ${apiToken}`
            }
          })

          const user=await response?.json()
          console.log("[update-user]", user)
          if (response.ok && user) {
            token?.user = user;
            return token;
          }
        }
        
        if(user){
          token.user = user;
        }

        return token;
      },
      async session({session, token}){
        if(!session) return;

        session.user=token?.user;
        return session;
      },
      async redirect({ url, baseUrl }) {
        return baseUrl
      }
    }
  })
}




const csrf = () => HttpService.get('/sanctum/csrf-cookie')




