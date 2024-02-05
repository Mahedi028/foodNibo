import Image from 'next/dist/client/image'
import React, { useState,useEffect } from 'react'
import classes from './tab.module.css'
import MenuCard from '@/components/menu/MenuCard'

function TabHeader({title,active,onClick,children,img}){
    return (
        <div className={`tab ${active ? 'active':''}`} onClick={onClick}>
          <div className={classes.tab__header}>
            <Image
                src={img}
                width={100}
                height={100}
            />
            <h2>{title}</h2>
          </div>
          {active && children} 
        </div>
    )
}

const Tab = ({categories}) => {


    useEffect(() => {
      
    }, [categories])
    

    const [activeTab, setActiveTab]=useState(1)



  return (
    <div className={classes.tab__container}>
        <div className={classes.tab__list}>
            {/* tab-header starts*/}
                {
                    categories && categories?.map((category) => (
                    <TabHeader
                        key={parseInt(category.id)}
                        title={category.name}
                        img={category.category_thumbnail}
                        active={activeTab === parseInt(category.id)}
                        onClick={() => setActiveTab(parseInt(category.id))}
                    />
                    )) 
                }
            {/* tab-header end*/}
        </div>
        <div className={classes.tab__content}>
            {/* tab-content starts */}
            {
                categories.map((category) =>  { 
                    return (
                        activeTab === parseInt(category.id) && (
                    <div key={parseInt(category.id)} className={classes.content}>
                    {
                        category?.menus?.map((menu)=><MenuCard menu={menu}/>)
                    }
                    </div>
                    )
                )})
            }
            {/* tab-content-end */}
        </div>
    </div>
  )
}

export default Tab

