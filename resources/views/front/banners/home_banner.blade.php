<?php
use App\Models\Banner;
$banners = Banner::getBanners();
?>
@if(isset($page_name) && $page_name=='index')
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
            @foreach($banners as $key => $val)
			<div class="item @if($key == 0)active @endif">
				<div class="container">
					<a href="{{$val['link']}}"><img style="width:100%" src="{{asset('images/banner_images/'.$val['image'])}}" alt="{{$val['alt']}}"/></a>
					<div class="carousel-caption">		
					</div>
				</div>
			</div>
            @endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
@endif