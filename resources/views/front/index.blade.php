
@extends('front_layout.layout')
@section('content')
<div class="span9">
				<div class="well well-small">
					<h4>Featured Products <small class="pull-right">{{$count}} featured products</small></h4>
					<div class="row-fluid">
						<div id="featured" @if($count>4) class="carousel slide" @endif>
							<div class="carousel-inner">
								@foreach($array_chunck as $key => $value)
								<div class="item @if($key == 0) active @endif">
									<ul class="thumbnails">
										@foreach($value as $val)
										<li class="span3">
											<div class="thumbnail">
												<i class="tag"></i>
												<a href="product/{{$val['id']}}">
												@if(!empty($val["main_image"]) && file_exists('images/product_images/small/'.$val['main_image']))	
												<img src="{{asset('images/product_images/small/'.$val['main_image'])}}" alt="">
												@else
												<img src="{{asset('images/product_images/small/no-image.png')}}" alt="">
												@endif 	
											</a>
												<div class="caption">
													<h5>{{$val["product_name"]}}</h5>
													<h4><a class="btn" href="product/{{$val['id']}}">VIEW</a> <span class="pull-right">Rs.{{$val["product_price"]}}</span></h4>
												</div>
											</div>
										</li>
										@endforeach
									</ul>
								</div>
								@endforeach
							</div>
							<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
							<a class="right carousel-control" href="#featured" data-slide="next">›</a>
						</div>
					</div>
				</div>
				<h4>Latest Products </h4>
				<ul class="thumbnails">
					@foreach($products as $key => $value)
					<li class="span3">
						<div class="thumbnail">
							<a  href="product/{{$value['id']}}">
								@if(!empty($value["main_image"]) && file_exists('images/product_images/small/'.$value['main_image']))	
								<img style="width:150px;" src="{{asset('images/product_images/small/'.$value['main_image'])}}" alt="">
								@else
								<img style="width:150px;" src="{{asset('images/product_images/small/no-image.png')}}" alt="">
								@endif 	
							</a>
							<div class="caption">
								<h5>{{ $value["product_name"] }}</h5>
								<p>
								{{ $value["product_code"] }}
								</p>
								
								<h4 style="text-align:center"><a class="btn" href="product/{{$value['id']}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
@endsection            