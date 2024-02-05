import React from 'react'
import styles from './hero.module.css'
import Image from 'next/image'
import Deal from '../deal/Deal'

const HeroSection = () => {
  return (
    <>
        <div style={{width:'100%',height:'100vh',position:'relative'}}>
            <Image
                alt='LayoutImg'
                src='/images/background/back1.png'
                layout='fill'
                objectFit='contain'
                className={styles.hero__image}
                />
        </div>
        <Deal/>
    </> 
  )
}

export default HeroSection