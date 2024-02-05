import React from 'react'
import CartButton from '@/components/UI/button/CartButton'
import classes from './ordertable.module.css'
import { useOrder } from '@/hooks/order'
import Link from 'next/link'

const OrderTable = () => {

    const {orders}=useOrder()

    console.log("[orders]",orders)

  return (
    <div className={classes.order__table__container}>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Invoice No</th>
                    <th>Transaction No</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th colSpan={2} className='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                {
                   orders && orders?.map((order)=>{
                    return(
                        <tr>
                            <td>{order.name}</td>
                            <td>{order.email}</td>
                            <td>{order.phone}</td>
                            <td>{order.invoice_no}</td>
                            <td>{order.transaction_id}</td>
                            <td>{order.payment_method}</td>
                            <td>{order.order_date}</td>
                            <td>{order.total_amount}</td>
                            <td>
                                <CartButton>
                                    <Link href={`/profile/user/orders/${order?.id}`}>view</Link>
                                </CartButton>
                            </td>
                            <td>
                                <CartButton>invoice</CartButton>
                            </td>
                        </tr>
                        )
                        })
                }
            </tbody>
        </table>
    </div>
  )
}

export default OrderTable