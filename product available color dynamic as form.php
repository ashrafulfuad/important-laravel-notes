	<div class="col-lg-6">
					<form action="{{ url('add/to/cart') }}" method="post">
					@csrf
					<input type="number" name="product_id" value="{{ $product_info->id }}">
					<div class="product-content">
						<h2>{{ $product_info->product_name }}</h2>
						<div class="pc-meta">
							<h4 class="price">${{ $product_info->product_price }}</h4>
							<div class="review">
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
								<span>(2 reviews)</span>
							</div>
						</div>
						<p>{{ $product_info->product_description }}</p>
						<div class="color-choose">
							<span>Colors:</span>
							@foreach ( json_decode($product_info->available_colors) as $available_color)
								@php
									$color_name = App\Color::find($available_color)->color_name;
									$color_code = App\Color::find($available_color)->color_code;
								@endphp
								<div class="cs-item">
									<input type="radio" value="{{ $available_color }}" name="cs" id="{{ $color_name }}-color" checked>
									<label class="cs-{{ $color_name }}" for="{{ $color_name }}-color"></label>
									<style media="screen">
									.product-content .color-choose label.cs-{{ $color_name }} {
										background: {{ $color_code }};
										}
										.product-content .color-choose label.cs-{{ $color_name }}:after {
										border: 1px solid {{ $color_code }};
										}
									</style>
								</div>
							@endforeach
						</div>
						<div class="size-choose">
							<span>Size:</span>
							<div class="sc-item">
								<input type="radio" name="sc" id="l-size" checked>
								<label for="l-size">L</label>
							</div>
							<div class="sc-item">
								<input type="radio" name="sc" id="xl-size">
								<label for="xl-size">XL</label>
							</div>
							<div class="sc-item">
								<input type="radio" name="sc" id="xxl-size">
								<label for="xxl-size">XXL</label>
							</div>
						</div>
						<button type="submit" class="site-btn btn-line">ADD TO CART</button>
					</div>
				</form>
			</div>
