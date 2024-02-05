import AppLayout from '@/components/layouts/AppLayout'
import MenuDetails from '@/components/menudetails/MenuDetails'
import { useRouter } from 'next/router'
import React from 'react'

const MenuDetailsPage = ({menu}) => {

  // const router=useRouter()

  // const {id}=router?.query

  console.log("[menu-props]",menu)



  

  
  return (
    <AppLayout>
        <MenuDetails menu={menu}/>
    </AppLayout>
  )
}

async function getAllMenus(){
  const res = await fetch(`http://127.0.0.1:8000/api/v1/allmenu`, {
      method: 'GET',
      headers: {
        'Content-Type': "application/json; charset=utf-8",
      },
      credentials: 'include',
      withCredentials: true,
    })
  
    const menus = await res?.json()

    return menus?.data || '';
}



export async function getStaticProps(context){
  const { params }=context

  const menuId=parseInt(params?.id);

  //calling menu-id api
  console.log("[menu-Id]",typeof(menuId))

  const menus= await getAllMenus()

  console.log("[menus]",typeof(menus[0]?.id))

  const menu=menus && menus?.find((menu)=>menu?.id===menuId)

  // console.log("[menu]",menu)

  return {
    props:{
      menu:menu || {}
    }
  }
}

export async function getStaticPaths(){

  const menus= await getAllMenus()

  const ids=menus?.map((menu)=>menu.id)

  console.log("[ids]",ids)

  const pathsWithParams=ids?.map((id)=>({params:{id:id.toString()}}))

  console.log("[params]",pathsWithParams)
  // const paths=menus?.map((menu)=>{
  //   params:{id:menus?.id}
  // })

  return {
    paths:pathsWithParams || {params:{}},
    // paths,
    fallback:false
  }
}

export default MenuDetailsPage
