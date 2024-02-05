import React, { useEffect } from 'react'
import classes from './categories.module.css'
import Tab from '../UI/tab/Tab'
const Categories = ({categories}) => {
    useEffect(() => {
     
    }, [categories])
    
  return (
    <>
      <div className={classes.categories__title}>Explore Foods</div>
      <Tab categories={categories}/>
    </>
    
  )
}

export default Categories