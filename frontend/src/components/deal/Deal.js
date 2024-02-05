import React, { Fragment } from 'react'
import classes from './deal.module.css'
import Image from 'next/image'
const Deal = () => {
  return (
    <Fragment>
    <div className={classes.banner__container}>
       <h2 className={classes.banner__title}>ARE YOU HUNGRY?</h2>
       <div className={classes.deals}>
            <ul>
                <li className={classes.deals__item}>
                    <h5 className={classes.deals__item__title}>Burger</h5>
                </li>
                <li>
                    <h5 className={classes.deals__item__title}>Fries</h5>
                </li>
                <li>
                    <h5 className={classes.deals__item__title}>Coca-cola</h5>
                </li>
                <Image
                    src='/images/deals/deal1.png'
                    width={250}
                    height={250}
                />
            </ul>
            <div className={classes.deals_price}>
                <h6>Only</h6>
                <h2>$35.99</h2>
            </div>
            <button className={classes.deals__add}><h2 className='text-center'>+</h2></button>
       </div>
    </div>
</Fragment>
  )
}

export default Deal