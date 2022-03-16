<?php


namespace App\Http\Arrays\Orders;


use App\Models\Order;

class OrderPrintDataArray
{
    private $orderDetail;
    public function __construct(Order $orderDetail)
    {
        $this->orderDetail=$orderDetail;
    }

    /**
     * Transform the object into an array in specified form.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'orderCode'=>$this->orderDetail->code,
            'orderDate'=>$this->orderDetail->created_at->format('d-m-Y  h:i A'),
            'status'=>$this->orderDetail->status,
            'customer'=>$this->orderDetail->user->name,
            'email'=>$this->orderDetail->user->email,
            'shippingAddress'=>$this->orderDetail->user->shipment_details ? $this->orderDetail->user->shipment_details->specific_address : '',
            'contact'=>$this->orderDetail->user->phone_number ?? '-',
            'paymentMethod'=>$this->orderDetail->paymentMethod,
            'date'=>$this->orderDetail->date,
            'time'=>$this->orderDetail->time,
            'coupon_detail'=>$this->orderDetail->coupon_detail,
            'coupon_discount_price'=>$this->orderDetail->coupon_discount_price,
            'sub_total'=>$this->orderDetail->sub_total,
            'tax'=>$this->orderDetail->tax,
            'total_price'=>$this->orderDetail->total_price,
        ];
    }
}