import React from 'react'
import classes from './profile.module.css'
import Image from 'next/dist/client/image'
import Link from 'next/dist/client/link'
import { useAuth } from '@/hooks/auth'
const Profile = ({userData}) => {

    console.log("[profile-user]",userData)
  return (
    <div className={`${classes.profile__container} container`}>
        <div className="row d-flex justify-content-center align-item-center">
            <div className="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div className={classes.user__details}>
                    <Image
                        src='/images/logo/apple.png'
                        width={150}
                        height={150}
                        className={classes.user__image}
                        alt='User'
                    />
                    <div className={classes.user__details__item}>
                        <Link href='/profile/edit' className='text-decoration-none'><h6>Profile</h6></Link>
                    </div>
                    <div className={classes.user__details__item}>
                        <Link href='/profile/change-password' className='text-decoration-none'><h6>Change Password</h6></Link>
                    </div>
                    <div className={classes.user__details__item}>
                        <Link href='/profile/user/orders' className='text-decoration-none'><h6> My Orders</h6></Link>
                    </div>
                </div>
            </div>
            <div className="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div className={classes.user__details__content}>
                {
                    userData && (
                        <h2>Welcome {userData?.data?.name}</h2>
                    )
                }
                </div>
            </div>
        </div>
    </div>
  )
}

export default Profile