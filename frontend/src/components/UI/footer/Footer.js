import React from 'react'
import classes from './footer.module.css'
import {BiTimeFive} from 'react-icons/bi'
import {ImLocation2} from 'react-icons/im'
import {BsFacebook,BsYoutube} from 'react-icons/bs'
import {AiFillInstagram,AiFillMail} from 'react-icons/ai'
import {FaMobileAlt} from 'react-icons/fa'
import {FaClock} from 'react-icons/fa'
import Image from 'next/image'
import Link from 'next/link'
import {MdDateRange} from 'react-icons/md'

const Footer = () => {
  return (
    <footer>
        <div className="row border-1 p-2">
          <div className="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-2">
            <h6 className={classes.footer__title}>Address</h6>
                <div className={classes.footer__item}>
                  <Image
                    src='/images/logo/logo.png'
                    width={80}
                    height={80}
                    objectFit='contain'
                  />
                   <p className='d-flex justify-content-center align-items-center'><ImLocation2 className='fs-0'/>California, street-1230</p>
                   <div className={classes.social__information}>
                        <Link href='/facebook'><BsFacebook className='fs-1'/></Link>
                        <Link href='/instagram'><AiFillInstagram className='fs-1'/></Link>
                        <Link href='/youtube'><BsYoutube className='fs-1'/></Link>
                   </div>
                </div>
          </div>
          <div className="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-2">
            <h4 className={classes.footer__title}>Opening Hours</h4>
              <div className={classes.footer__item}>
                <p className='d-flex flex-row justify-content-center align-items-center gap-1'><MdDateRange className='fs-1'/> Saturday-Wednesday</p>
                <p className='d-flex flex-row justify-content-center align-items-center gap-1'><FaClock className='fs-1'/>9.00am-10:pm</p>
              </div>
          </div>
          <div className="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-2">
            <h4 className={classes.footer__title}>Customer care</h4>
                <div className={classes.footer__item}>
                  <p className='d-flex flex-row gap-1'><FaMobileAlt className='fs-1'/> +(880)1309191185</p>
                  <p className='d-flex flex-row gap-1'><AiFillMail className='fs-1'/> support@gmail.com</p>
                </div>
          </div>
          <div className="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-2">
          <h4 className={classes.footer__title}>Download APP</h4>
                <div className={classes.footer__item}>
                    <Image
                      src='/images/logo/apple.png'
                      width={180}
                      height={60}
                      alt="footer-logo"
                      objectFit='contain'
                    />
                    <Image
                      src='/images/logo/google.png'
                      width={180}
                      height={60}
                      alt="footer-logo"
                      objectFit='contain'
                    />
                </div>
          </div>
        </div>
    </footer>
  )
}

export default Footer