@extends('layouts.store')

@section('title')
	96Legacy Shop | checkout
	
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row medium-padding120 bg-border-color">
			<div class="container">

				<div class="row">

					<div class="col-lg-12">
				<div class="order">
					<h2 class="h1 order-title text-center">Checkout Your Order</h2>
					<div  class="cart-main">
						<table class="shop_table cart">
							<thead class="cart-product-wrap-title-main">
							<tr>
								<th class="product-thumbnail">Product</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-subtotal">Total</th>
							</tr>
							</thead>
							<tbody>

							@foreach (Cart::getContent() as $item)
							<tr class="cart_item">

								<td class="product-thumbnail">

									<div class="cart-product__item">
										<div class="cart-product-content">
											<h5 class="cart-product-title">{{ $item->name }}</h5>
										</div>
									</div>
								</td>

								<td class="product-quantity">

									<div class="quantity">
										x {{ $item->quantity }}
									</div>

								</td>

								<td class="product-subtotal">
									<h5 class="total amount">MWK {{ $item->getPriceSum() }}.00</h5>
								</td>

							</tr>
							@endforeach						

							

							<tr class="cart_item total">

								<td class="product-thumbnail">


									<div class="cart-product-content">
										<h5 class="cart-product-title">Total:</h5>
									</div>


								</td>

								<td class="product-quantity">

								</td>

								<td class="product-subtotal">
									<h5 class="total amount">MWK {{ Cart::getTotal() }}.00</h5>
								</td>
							</tr>

							</tbody>
						</table>

						<div class="cheque">
							Supported Payments: 
							<div class="logos">
								<a href="#" class="logos-item">
									TNM Mpamba
								</a>
								<a href="#" class="logos-item">
									Airtel Money
								</a>
								<a href="#" class="logos-item">
									FDH
								</a>
								<a href="#" class="logos-item">
									Mo626
								</a>
								<a href="#" class="logos-item">
									Visa
								</a>
								<a href="#" class="logos-item">
									MasterCard
								</a>
								
								{{-- <span style="float: right;">
									<form action="/your-server-side-code" method="POST">
										<script
											src="https://checkout.stripe.com/checkout.js" class="stripe-button"
											data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
											data-amount="999"
											data-name="Stripe.com"
											data-description="Widget"
											data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
											data-locale="auto"
											data-zip-code="true">
										</script>
									</form>
								</span> --}}
							</div>
						</div>
						
					</div>
					<div class="h4 text-center">

						<button id="button" class="btn btn-success btn-xl btn-round float-right">Pay Using Zachangu</button><hr>
						<span class="text-small lead-90">Zachangu supports Mpamba, Airtel Money, Mo626</span>
						<p style="margin-top:20px;">
							<a  class="btn btn-success btn-xl btn-round float-right" href="https://zachangu.xyz/download">GET THE ZACHANGU APK APP</a>
						</p>
					</div>

					<!--zachangu -->
						<div class="popup">
							<?php //if(isset($paymentProviders->feedback)){?>
								<ul>
										<ol>PAY WITH</ol>
									<?php //foreach ($paymentProviders->feedback as $name => $provider){?>
										<li class="li">
											<span><img src="https://zachangu.xyz/assets/images/237036.png"></span>
											<span>AIRTELMONEY</span>
										</li>
										<li class="li">
											<span><img src="https://zachangu.xyz/assets/images/185733.png"></span>
											<span>MPAMBA</span>
										</li>                
									<?php //} ?>
									<ol id="cancel">Cancel</ol>
								</ul>
							<?php //} ?>
						</div>

							<form method="post" id="submit_invoice" action="https://ussd.wgithost.xyz/api/checkout">
								@csrf
								<input type="hidden" name="identifier" value="{{ $zachangu->randomId() }}">
								<input type="hidden" name="description" value="Purchase at 96Legacy.com">
								<input type="hidden" name="merchant_key" value="{{ $zachangu->zachangu_api_key }}">
								<input type="hidden" name="amount" id="amount" value="{{ Cart::getTotal() }}">
								<input type="hidden" name="provider" id="provider" value="">
								<input type="hidden" name="success_url" value="{{ route('cart.checkout.zachangu.success') }}">
								<input type="hidden" name="error_url" value="{{ route('cart.checkout.zachangu.error') }}">
							</form>

				</div>
			</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('li').on('click',function(){
			let value = $(this).find('span').last().html();
			$("#provider").val(value);
			$('#submit_invoice').submit();
		});

		$('#button').on('click',function(){
			$(".popup").show();
		});

		$('#cancel').on('click',function(){
			$(".popup").hide();
		});
	});
</script>
@endsection