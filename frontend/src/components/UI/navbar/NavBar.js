import React, { useEffect, useRef } from 'react'
import Link from 'next/link'
import styles from './navbar.module.css'
import Image from 'next/image'
import {FaBars, FaTimes} from 'react-icons/fa'
import { useSession,signOut} from 'next-auth/react'
import CartButton from '../button/CartButton'
import {BsFillCartPlusFill} from 'react-icons/bs'
import { useCart } from '@/hooks/cart'
import { useAuth } from '@/hooks/auth'
const NavBar = () => {

    const {data:session}=useSession()

    const {user}=useAuth()

    const {name,email,phone_number}=user?.data || {}


    const {cart}=useCart({
        authenticatedUser:email?email:"",
        redirectIfAuthenticated:"/login"
    })

    const cartItems=cart?.data || []

    console.log("[cart-length]",cartItems.length)


    console.log("[session]",session)

    const navRef=useRef()

    const navOpen=()=>{
        navRef.current.classList.toggle(`${styles.responsive_nav}`);
    }


    useEffect(() => {
      
    }, [session])


  return (
    <header>
        <nav ref={navRef}>
            <div className={styles.nav__logo}>
                <Image
                    src='/images/logo/logo.png'
                    width={150}
                    height={70}
                    alt="footer-logo"
                />
                 </div>
            <ul className={styles.nav__menu}>
                <li className={styles.nav__menu__item}>
                    <Link href='/menu' className={styles.nav__menu__link}>menu</Link>
                </li>
                <li className={styles.nav__menu__item}>
                    <Link href='/blog' className={styles.nav__menu__link}>blog</Link>
                </li>
                <li className={styles.nav__menu__item}>
                    <Link href='/about' className={styles.nav__menu__link}>about</Link>
                </li>
            </ul>
            {
                session && session?.user?(
                    <ul className={styles.nav__menu}>
                        <li className={styles.nav__menu__item}>
                            <Link href='/profile' className={styles.nav__menu__link}>profile</Link>
                        </li>
                        <li className={styles.nav__menu__item}>
                            <CartButton onClick={signOut}>
                                logout
                            </CartButton>
                        </li>
                        <li className={styles.nav__menu__item}>
                            <Link href='/cart'>
                                <CartButton><BsFillCartPlusFill/><span><sup>{cartItems && cartItems.length}</sup></span></CartButton>
                            </Link>
                        </li>
                    </ul>
            ):(
                <ul className={styles.nav__menu}>
                    <li className={styles.nav__menu__item}>
                        <Link href='/register' className={styles.nav__menu__link}>register</Link>
                    </li>
                    <li className={styles.nav__menu__item}>
                        <Link href='/login' className={styles.nav__menu__link}>login</Link>
                    </li>
                </ul>
            )
            }
          
            
            <button onClick={navOpen} className={`${styles.nav__bar__btn} ${styles.nav__bar__btn__close}`}>
                <FaTimes/>
            </button>
        </nav>
        <button onClick={navOpen}  className={`${styles.nav__bar__btn} ${styles.nav__bar__btn__close}`}>
            <FaBars/>
        </button>
    </header>
  )
}

export default NavBar