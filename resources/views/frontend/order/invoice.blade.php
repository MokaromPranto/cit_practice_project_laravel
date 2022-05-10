

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <style>
        body{
            font-family: Helvetica, sans-serif;
            font-size:13px;
        }
        .container{
            max-width: 680px;
            margin:0 auto;
        }
        .logotype{
            background:#000;
            color:#fff;
            width:75px;
            height:75px;
            line-height: 75px;
            text-align: center;
            font-size:11px;
        }
        .column-title{
            background:#eee;
            text-transform:uppercase;
            padding:15px 5px 15px 15px;
            font-size:11px
        }
        .column-detail{
            border-top:1px solid #eee;
            border-bottom:1px solid #eee;
        }
        .column-header{
            background:#eee;
            text-transform:uppercase;
            padding:15px;
            font-size:11px;
            border-right:1px solid #eee;
        }
        .row{
            padding:7px 14px;
            border-left:1px solid #eee;
            border-right:1px solid #eee;
            border-bottom:1px solid #eee;
        }
        .alert{
            background: #ffd9e8;
            padding:20px;
            margin:20px 0;
            line-height:22px;
            color:#333
        }
        .socialmedia{
            background:#eee;
            padding:20px;
            display:inline-block
        }
    </style>
</head>
@foreach ($order_details as $order_detail )

@endforeach
<body>
    <div class="container">
        <table width="100%">
          <tr>
            <td width="75px"><div class="logotype">Copmany</div></td>
            <td width="300px"><div style="background: #ffd9e8;border-left: 15px solid #fff;padding-left: 30px;font-size: 26px;font-weight: bold;letter-spacing: -1px;height: 73px;line-height: 75px;">Order invoice</div></td>
            <td></td>
          </tr>
        </table>
        <br><br>
        <h3>Your contact details</h3>
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p><br> --}}
        <table width="100%" style="border-collapse: collapse;">
          <tr>
            <td widdth="50%" style="background:#eee;padding:20px;">
              <strong>Date:</strong> {{ $order_detail->created_at->format('d-M-Y') }}<br>
              <strong>Ordered By:</strong>{{ $order_detail->relationwithordersummary->customer_name }}<br>
              <strong>Payment type:</strong> {{ ( $order_detail->relationwithordersummary->payment_method == 'cod') ? 'Cash On Delivery' : 'Onilne Payment' }}<br>
            </td>
            <td style="background:#eee;padding:20px;">
              <strong>Order No:</strong> {{ $order_detail->id }}<br>
              <strong>E-mail:</strong> {{ $order_detail->relationwithordersummary->customer_email }}<br>
              <strong>Phone:</strong> {{ $order_detail->relationwithordersummary->customer_phone_number }}<br>
            </td>
          </tr>
        </table><br>
        <table width="100%">
          <tr>
            <td>
              <table>
                <tr>
                  <td style="vertical-align: text-top;">
                    <div style="background: #ffd9e8 url(https://cdn0.iconfinder.com/data/icons/commerce-line-1/512/comerce_delivery_shop_business-07-128.png);width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 42px;"></div>
                  </td>
                  <td>
                    <strong>Delivery</strong><br>
                    {{ $order_detail->relationwithordersummary->customer_name }}<br>
                    {{ $order_detail->relationwithordersummary->customer_address }}<br>
                    {{ $order_detail->relationwithordersummary->customer_city }} | {{ $order_detail->relationwithordersummary->customer_country }}
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table>
                <tr>
                  <td style="vertical-align: text-top;">
                    <div style="background: #ffd9e8 url(https://cdn4.iconfinder.com/data/icons/app-custom-ui-1/48/Check_circle-128.png) no-repeat;width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 25px;"></div>
                  </td>
                  <td>
                    <strong>Coupon</strong><br>
                    @if ($order_detail->coupon_name == NULL)
                        No Coupon Used
                    @else
                        {{ $order_detail->coupon_name }}
                    @endif<br>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table><br>

        <div style="background: #ffd9e8 url(https://cdn4.iconfinder.com/data/icons/basic-ui-2-line/32/shopping-cart-shop-drop-trolly-128.png) no-repeat;width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 25px;float: left; margin-bottom: 15px;"></div>
        <h3>Ordered Items</h3>

         <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
           <tr>
             <td width="40%" class="column-header">Product Name</td>
             <td width="20%" class="column-header">Color | Size</td>
             <td width="20%" class="column-header">Price</td>
             <td width="20%" class="column-header">Subtotal</td>
           </tr>

           @foreach ($order_details as $order_detail)
            <tr>
                <td class="row"><span style="color:#777;font-size:11px;">{{ $order_detail->relationwithproduct->product_sku }}</span><br>{{ $order_detail->relationwithproduct->product_name }}</td>
                <td class="row">{{ $order_detail->relationwithcolor->color_name }} | {{ $order_detail->relationwithsize->size_name }}</td>
                <td class="row">{{ $order_detail->amount }}<span style="color:#777"> X </span>
                    @if ($order_detail->relationwithproduct->product_discounted_price)
                    {{ $unit_prize  = $order_detail->relationwithproduct->product_discounted_price }}
                    @else
                    {{ $unit_prize = $order_detail->relationwithproduct->product_regular_price }}
                    @endif
                </td>
                <td class="row">{{ $unit_prize*$order_detail->amount }}</td>
            </tr>
           @endforeach
        </table><br>
        <table width="100%" height="auto" style="background:#eee;padding:20px;">
          <tr>
            <td>
              <table width="300px" style="float:right">
                <tr>
                  <td><strong>Total Amount:</strong></td>
                  <td style="text-align:right">{{ $order_detail->relationwithordersummary->total_ammount }}</td>
                </tr>
                <tr>
                  <td><strong>Shipping Charge (+):</strong></td>
                  <td style="text-align:right">{{ $order_detail->relationwithordersummary->shipping_charge }}</td>
                </tr>
                <tr>
                  <td><strong>Coupon Discount (-):</strong></td>
                  <td style="text-align:right">{{ $order_detail->relationwithordersummary->discount_amount }}</td>
                </tr>
                <tr>
                  <td><strong>Grand Total:</strong></td>
                  <td style="text-align:right">{{ $order_detail->relationwithordersummary->grand_total }}</td>
                </tr>
              </table>
             </td>
          </tr>
        </table>
      </div><!-- container -->
</body>
</html>

