<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>A simple, clean, and responsive HTML invoice template</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: center;
			}
			.invoice-box table tr td:nth-child(3) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total{
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="3">
						<table>
							<tr>
								<td class="title">
									<img src="https://i.postimg.cc/5ydBYG9T/logo-1x.png" alt="Company logo" style="width: 150px;">
								</td>
                                <td></td>
								<td>
									Invoice #: {{ $orders->first()->id }}<br />
									Created: {{ $orders->first()->created_at }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td>
									{{ $billingDetails->first()->address }}
								</td>
                                <td></td>
								<td>
									{{ $billingDetails->first()->company }}<br />
									{{ $billingDetails->first()->name }}<br />
									{{ $billingDetails->first()->email }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>
                    @php
                        if($orderDetail->first()->payment_method == 1){
                            $payment_type = "Cash On Delivery";
                        }
                        else if($orderDetail->first()->payment_method == 2){
                            $payment_type = "SSL Commerz";
                        }
                        else{
                            $payment_type = " Stripe Payment";
                        }
                    @endphp
                    <td colspan="3" style="text-align: right">{{ $payment_type }}</td>
				</tr>

				<tr class="details">
                    <td colspan="3"></td>
				</tr>

				<tr class="product_details">
                    <td colspan="4">
                        <table style="width: 100%">
                            <tr class="heading">
                                <td>Item</td>
                                <td>Price</td>
                                <td style="text-align: center">Quantity</td>
                                <td style="text-align: right">Total</td>
                            </tr>

                            @foreach ($orderDetail as $products)
                            <tr class="item">
                                <td>{{ $products->rel_to_product->product_name }}</td>
                                <td>{{ $products->price }}</td>
                                <td style="text-align: center">{{ $products->quantity }}</td>
                                <td style="text-align: right">{{ $products->price * $products->quantity }}</td>
                            </tr>
                            @endforeach

                            <tr class="total">
                                <td colspan="3"></td>
                                <td style="text-align: right">SubTotal: {{ $orders->first()->subtotal }}/-</td>
                            </tr>
                            <tr class="total">
                                <td colspan="3"></td>
                                <td style="text-align: right">Discount: {{ $orders->first()->discount }}/-</td>
                            </tr>
                            <tr class="total">
                                <td colspan="3"></td>
                                <td style="text-align: right">Charge: {{ $orders->first()->charge }}/-</td>
                            </tr>
                            <tr class="total">
                                <td colspan="3"></td>
                                <td style="text-align: right">Grand Total: {{ $orders->first()->total_price}}/-</td>
                            </tr>
                        </table>
                    </td>
                </tr>
			</table>
		</div>
	</body>
</html>

