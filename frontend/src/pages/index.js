import Head from 'next/head'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth'
import AppLayout from '@/components/layouts/AppLayout'
import HeroSection from '@/components/hero/HeroSection'
import Categories from '@/components/categories/Categories'
import { useEffect } from 'react'

export default function Home({categories}) {

    // console.log("[categories]",categories)

    useEffect(() => {
    
    }, [categories])
    
    return (
        <>
            <Head>
                <title>Laravel</title>
            </Head>
           <AppLayout>
                <HeroSection/>
                <Categories categories={categories}/>
           </AppLayout>
        </>
    )
}

export async function getServerSideProps(context) {
  
    const res = await fetch("http://127.0.0.1:8000/api/v1/menulistbycategory", {
      method: 'GET',
      headers: {
        'Content-Type': "application/json; charset=utf-8",
      },
      credentials: 'include',
      withCredentials: true,
    })
  
    const categories = await res?.json()
  
    return {
      props: {
        categories:categories?.data
      }
    }
  }
  
