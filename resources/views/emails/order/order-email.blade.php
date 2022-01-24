<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Murarkey Email Template</title></head>

<body style="overflow-x: hidden;">
<div style="margin: 0 !important; padding: 0 !important; font-family: Arial, Helvetica, sans-serif; ">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td width="100%" align="center" valign="top" bgcolor="#F4EFF6" height="20"></td>
        </tr>
        <tr>
            <td bgcolor="#F4EFF6" align="center" style="padding: 0px 15px 0px 15px">
                <table width="100%" style="max-width: 600px; background-color: #ffffff;">
                    <tbody>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td align="center" style="padding: 40px 40px 0px 40px">
                                        <a href="" target="_blank"> <img
                                                    src="http://murarkey.com/frontend/img/logo-primary.png" width="120"
                                                    border="0" style="vertical-align: middle"/> </a></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; color: #555555; padding: 20px 20px 0 20px; ">
                                        <table cellspacing="0" cellpadding="0"
                                               style=" width: 100%; border-spacing: 0; border-collapse: collapse; ">
                                            <tbody>
                                            <tr>
                                                <td style="background-color: #f7f7f7">
                                                    <table style=" border: 1px solid #dddddd; border-collapse: collapse; margin: 0 auto; ">
                                                        <tbody>
                                                        <tr>
                                                            <td style=" background-color: #ffffff; ">
                                                                <table valign="top" width="100%"
                                                                       style=" border-collapse: collapse; padding: 0; margin: 0; ">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <p style="padding: 0px 0 0 20px;">{!! $greeting !!}
                                                                                <br/> <br/>
                                                                                {!! $level !!}
                                                                            <p style=" padding: 0px 0 0 20px; ">{!! $cancelMessage !!}</p>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div style="padding: 0 20px 20px;"
                                                                                 class="order-summary">
                                                                                <h3 style="color: #252525; font-weight: 700; margin-bottom: 10px; font-size: 1.1rem;">
                                                                                    Order summary </h3>
                                                                                <div style="display: block; width: 100%; overflow-x: auto;">
                                                                                    <table style=" width: 100%; line-height: 180%;margin-bottom: 1rem;color: #212529;font-size: 0.9rem;">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td style="min-width: 90px">
                                                                                                Order Code
                                                                                            </td>
                                                                                            <td>{!! $order->code !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Order date</td>
                                                                                            <td>{!! $order->created_at !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Customer</td>
                                                                                            <td>{{$user->first_name}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Total order amount</td>
                                                                                            <td>{{$order->total_price}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Payment Method</td>
                                                                                            <td>{{$order->payment_method}}</td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <!-- product Details -->
                                                                                    <div style="width: 100%;overflow-x: scroll;">
                                                                                        <table style="width: 100%;border: 1px solid #ccc;border-spacing: initial;">
                                                                                            <thead style="background-color: rgb(137 36 155 / 9%);">
                                                                                            <tr style="color: #89249b;">
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Product Name
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;min-width: 90px;">
                                                                                                    Qty * Price
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Amount
                                                                                                </th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            @foreach($orderItem as $item)
                                                                                                @if($item->options['product_type']=='product')
                                                                                                    <tr>
                                                                                                        <td style="padding:0.5rem;min-width: 200px">
                                                                                                            {{$item->product->name}}
                                                                                                        </td>
                                                                                                        <td style="padding:0.5rem;min-width: 80px;">
                                                                                                            <span>{{$item->qty}}</span>*
                                                                                                            <span>{{$item->price}}</span>
                                                                                                        </td>
                                                                                                        <td style="padding:0.5rem;text-align: right;min-width: 80px">
                                                                                                            {{$item->qty*$item->price}}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @else
                                                                                                    <tr>
                                                                                                        <td style="padding:0.5rem;min-width: 200px">
                                                                                                            {{$item->service->title}}
                                                                                                        </td>
                                                                                                        <td style="padding:0.5rem;min-width: 80px;">
                                                                                                            <span>{{$item->qty}}</span>*
                                                                                                            <span>{{$item->price}}</span>
                                                                                                        </td>
                                                                                                        <td style="padding:0.5rem;text-align: right;min-width: 80px">
                                                                                                            {{$item->qty*$item->price}}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif

                                                                                            @endforeach
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                            <tr>
                                                                                                <th style="padding:0.5rem;"></th>
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Subtotal
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;text-align: right; min-width: 80px">
                                                                                                   Rs. {{$order->sub_total}}
                                                                                                </th>
                                                                                            </tr>
                                                                                            @if($order->coupon_discount_price)
                                                                                            <tr>
                                                                                                <th style="padding:0.5rem;"></th>
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Coupon Discount
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;text-align: right; min-width: 80px">
                                                                                                    Rs. {{$order->coupon_discount_price}}
                                                                                                </th>
                                                                                            </tr>
                                                                                            @endif
                                                                                            @if($order->tax)
                                                                                            <tr>
                                                                                                <th style="padding:0.5rem;"></th>
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Tax
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;text-align: right; min-width: 90px; color: #89249b;font-weight: 800;">
                                                                                                    Rs. {{$order->tax}}
                                                                                                </th>
                                                                                            </tr>
                                                                                            @endif

                                                                                            <tr>
                                                                                                <th style="padding:0.5rem;"></th>
                                                                                                <th style="padding:0.5rem;">
                                                                                                    Total
                                                                                                </th>
                                                                                                <th style="padding:0.5rem;text-align: right; min-width: 90px; color: #89249b;font-weight: 800;">
                                                                                                    Rs. {{$order->total_price}}
                                                                                                </th>
                                                                                            </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                    </div>
                                                                                    <!-- product Details -->

                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="20" style=" height: 20px; "></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" align="center" valign="top" bgcolor="#ffffff" height="45"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#F4EFF6" align="center" style="padding: 20px 0px">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 600px">
                    <tbody>
                    <tr></tr>
                    <tr>
                        <td bgcolor="#F4EFF6" align="center">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"
                                   style="max-width: 600px">
                                <tbody>
                                <tr>
                                    <td align="center" style=" text-align: center; padding: 10px 10px 10px 10px; ">  <a
                                                href="http://instagram.com/murarkey?utm_medium=email&utm_source=system_email"
                                                style=" display: inline-block; margin: 2px; " target="_blank"><img
                                                    height="40"
                                                    src="https://ci3.googleusercontent.com/proxy/LjzXeoCp_o0AZnQQR1R9LK_YM9W_H_aFgIvVOnagU1PzJKdS2aX_q84El48dBC4jgGZY-qFgSOgUgF5np5xGunT5qt-QJVflsuJ1gOFqwgK_BCCCz9gnuHpib2ZM-Z3VjtKnBuGdLFsFSZaQEmwtQg=s0-d-e1-ft#https://murarkey-res.cloudinary.com/q_auto,f_auto/v1/general_assets/system_emails/Instagram.png"
                                                    width="40"/></a>

                                    </td>
                                </tr>
                                <tr></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>

