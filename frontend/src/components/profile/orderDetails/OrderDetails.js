import React from 'react'
import classes from './orderdetails.module.css'
const OrderDetails = ({order,orderItems}) => {


  return (
    <div className={classes.order_details_container}>
        <h2 className='text-danger'>Order Number #34455AD</h2>
        <div className="row">
            <div className="col-lg-8 col-md-8 col-sm-12">
                <div className={classes.items_summary}>
                    <table>
                        <thead>
                            <tr>
                                <th>items summary</th>
                                <th>quantity</th>
                                <th>price</th>
                                <th>total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                              orderItems && orderItems.map(orderItem=>{
                                return (
                                    <tr>
                                        <td>{orderItem?.menu?.title}</td>
                                        <td>{orderItem?.quantity}</td>
                                        <td>{orderItem?.price}</td>
                                        <td>{orderItem?.price}</td>
                                    </tr>
                                )
                              })
                            }
                        </tbody>
                    </table>
                </div>
                <div className={classes.items_summary}>
                    <h4>Customer and Order Details</h4>
                    <hr/>
                    {
                        order && (
                            <>
                                <div className="d-flex justify-content-between">
                                    <h6>Name</h6>
                                    <p>{order?.name}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Email</h6>
                                    <p>{order?.email}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Phone</h6>
                                    <p>{order?.phone}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Address</h6>
                                    <p>{order?.address}</p>
                                    <hr/>
                                </div>
                            </>  
                        )
                    }
                  
                </div>
            </div>
            <div className="col-lg-4 col-md-4 col-sm-12">
                <div className={classes.items_summary}>
                    <h4>Order Summary (<span className='text-danger'>{order?.operational_status}</span>)</h4>
                    <hr/>
                    {
                        order && (
                            <>
                                <div className="d-flex justify-content-between">
                                    <h6>Order Date</h6>
                                    <p>{order?.order_date}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Total</h6>
                                    <p>{(order?.amount)/100}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Phone</h6>
                                    <p>{order?.phone}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Address</h6>
                                    <p>{order?.address}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Payment Method</h6>
                                    <p>{order?.payment_type}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>TrxID</h6>
                                    <p>{order?.transaction_id}</p>
                                </div>
                                <hr/>
                            </>  
                        )
                    }
                  
                </div>
                <div className={classes.items_summary}>
                    <h4>Shipping Address</h4>
                    <hr/>
                    {
                        order && (
                            <>
                                <div className="d-flex justify-content-between">
                                    <h6>Division</h6>
                                    <p>{order?.division?.name}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>District</h6>
                                    <p>{order?.district?.name}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>State</h6>
                                    <p>{order?.state?.name}</p>
                                </div>
                                <hr/>
                                <div className="d-flex justify-content-between">
                                    <h6>Address</h6>
                                    <p>{order?.address}</p>
                                </div>
                                <hr/>
                            </>  
                        )
                    }
                  
                </div>
            </div>
        </div>
    </div>
  )
}

export default OrderDetails