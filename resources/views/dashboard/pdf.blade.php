<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </head>
  <body>
  	<div>
  		<div>
  			<div class="text-right" style="float: right;">
  				<span>AdSector</span><br>
  				<span>https://adsector.com/acount</span>
  			</div>
  		</div>
  		<p style="clear: both;"></p>
  		<div class="w-100 bg-dark" style="height: 2px"></div>
  		<div >
  			<div class="text-left" style="float: left">
  				<span>{{ $payment->payer_id }}</span><br>
  				<span>{{ $payment->date }}</span>
  			</div>
  			<div class="text-right" style="float: right; padding-bottom: 50px">
  				<span>{{ $user->first_name." ".$user->last_name }}</span><br>
  				<span>{{ $user->email }}</span>
  			</div>
  		</div>
		<p style="clear: both;"></p>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Subscription/Product Title</th>
					<th>QTY</th>
					<th>Unit Price</th>
					<th>Total Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $payment->description }}</td>
					<td>1</td>
					<td>{{ "$".$payment->amount.'.00' }}</td>
					<td>{{ "$".$payment->amount.'.00' }}</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered w-25">
			<thead>
				<tr>
					<th>Subtotal</th>
					<th>{{ "$".($payment->amount + $payment->discount).".00" }}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Discount</td>
					<td>{{ "$".$payment->discount.".00"}}</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>{{ "$".$payment->amount.".00"}}</td>
				</tr>
			</tbody>
		</table>
		<p style="clear: both;"></p>
		<p class="text-right" style="padding-top: 30px ">Subscription Terms: {{ "$".$payment->amount.".00"}} for each mont</p>
  	</div>
  </body>
</html>
