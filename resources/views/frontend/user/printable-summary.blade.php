<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8" /> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> --}}
    {{-- <title>Murarkey</title> --}}

    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body style="padding: 0;margin: 0;">
<div style="">
    <img src="{{$logo}}" alt="">
</div>
<div style="background-color: #f3f3f3;padding: 1rem;">
    <div style="width:90%; margin-left: auto;margin-right: auto;">
        <div style="background-color: #fff;margin-bottom: 2rem;padding: 2rem;">
            <h2 style="margin-bottom: 1rem;">Order summary</h2>
            <table>
                <tbody>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Order Code
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['orderCode']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Order date
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['orderDate']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Customer
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['customer']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Order Status
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['status']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Email
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['email']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Total order amount
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{convert($orderData['total_price'])}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Shipping Address
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['shippingAddress']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Contact
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['contact']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Payment Method
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['paymentMethod']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Appointment/Delivery Date
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['date']}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Appointment/Delivery Time
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{$orderData['time']}}</td>
                </tr>
                </tbody>
            </table>

        </div>
        <div style="background-color: #fff;margin-bottom: 2rem;padding: 2rem;">

            <h2 style="margin-bottom: 1rem;">Order details</h2>

            <table style="width: 100%;text-align: left;">
                <thead>
                <th>#</th>
                {{-- <th>Item</th> --}}
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                </thead>
                <tbody>
                @foreach ($orderItemData as $item)
                    <tr>
                        <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 40px; border-bottom: 1px solid #f0f0f0;">{{++$loop->index}}</td>
                        {{-- <td style="padding-bottom: 0.5rem;padding-top:0.5rem; border-bottom: 1px solid #f0f0f0;">
                          <div style="display: flex;">
                            <img src="{{$item['photo']}}" style="width: 60px;height: 60px;object-fit: contain;" alt="product-img" />
                          </div>
                        </td> --}}
                        <td style="padding-bottom: 0.5rem;padding-top:0.5rem;width: 200px;; border-bottom: 1px solid #f0f0f0;">
                            {{$item['name']}}
                        </td>

                        <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                            {{$item['qty']}}
                        </td>

                        <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                            {{convert($item['price'])}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{ dd($summary['subTotal']) }} --}}
        <div style="background-color: #fff;margin-bottom: 2rem;padding: 2rem;">
            <h2 style="margin-bottom: 1rem;">Order Amount</h2>
            <table>
                <tbody>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        Subtotal
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{convert($orderData['sub_total'])}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        TAX
                    </td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">{{convert($orderData['tax'])}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        <strong>Total</strong></td>
                    <td style="padding-bottom: 0.5rem;padding-top:0.5rem;min-width: 160px; border-bottom: 1px solid #f0f0f0;">
                        <strong>{{convert($orderData['total_price'])}}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
