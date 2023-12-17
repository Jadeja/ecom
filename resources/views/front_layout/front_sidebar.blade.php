<?php
use App\Models\Section;
$sections = Section::sections();
?>
<div id="sidebar" class="span3">
				<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('images/front_images/ico-cart.png')}}" alt="cart">3 Items in your cart</a></div>
				<ul id="sideManu" class="nav nav-tabs nav-stacked">
                    @foreach($sections  as $section)
                    @if(count($section["categories"])>0)
					<li class="subMenu"><a>{{$section['name']}}</a>
                    @foreach($section["categories"] as $categories)
						<ul>
							<li><a href="<?php $url = url($categories["url"]); echo $url;?>"><i class="icon-chevron-right"></i><strong>{{$categories['category_name']}}</strong></a></li>
                            @foreach($categories["subcategories"] as $category)
							<li><a href="<?php $url = url($category["url"]); echo $url;?>"><i class="icon-chevron-right"></i>{{ $category['category_name']}}</a></li>
                            @endforeach
						</ul>
                    @endforeach    						
					</li>
                    @endif
				    @endforeach
				</ul>
				<br>
				@if(isset($page) && $page=="listing")
				<div class="well well-small">
					<h5>Fabric</h5>
					@foreach($fabricArray as $fabric)
						<input type="checkbox" class="filter fabric" name="fabric[]" style="margin-top:-3px;" id="fabric" value="{{$fabric}}">&nbsp;&nbsp;{{$fabric}}<br>
					@endforeach
				</div>	
				<div class="well well-small">
					<h5>Sleeve</h5>
					@foreach($sleeveArray as $sleeve)
						<input type="checkbox" class="filter sleeve" name="sleeve[]" style="margin-top:-3px;" id="sleeve" value="{{$sleeve}}">&nbsp;&nbsp;{{$sleeve}}<br>
					@endforeach
				</div>	
				<div class="well well-small">
					<h5>Pattern</h5>
					@foreach($patternArray as $pattern)
						<input type="checkbox" class="filter pattern" name="pattern[]" style="margin-top:-3px;" id="pattern" value="{{$pattern}}">&nbsp;&nbsp;{{$pattern}}<br>
					@endforeach
				</div>	
				<div class="well well-small">
					<h5>Fit</h5>
					@foreach($fitArray as $fit)
						<input type="checkbox" class="filter fit" name="fit[]" style="margin-top:-3px;" id="fit" value="{{$fit}}">&nbsp;&nbsp;{{$fit}}<br>
					@endforeach
				</div>	
				<div class="well well-small">
					<h5>Occassion</h5>
					@foreach($occasionArray as $occassion)
						<input type="checkbox" class="filter occassion" name="occassion[]" style="margin-top:-3px;" id="occassion" value="{{$occassion}}">&nbsp;&nbsp;{{$occassion}}<br>
					@endforeach
				</div>																		
				@endif
				<br/>
				<div class="thumbnail">
					<img src="{{asset('images/front_images/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
					<div class="caption">
						<h5>Payment Methods</h5>
					</div>
				</div>
			</div>