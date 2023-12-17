@extends('front_layout.layout')
@section('content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{route('listing')}}">Home</a> <span class="divider">/</span></li>
				<li class="active">{!! $breadcame !!}</li>
			</ul>
			<h3> Products Name <small class="pull-right"> {{count($categoryProducts)}} products are available </small></h3>
			<hr class="soft"/>
			<p>
                {{$categoryDetails['catDetails']['description']}}
			</p>
			<hr class="soft"/>
			<form name="productFilter" class="form-horizontal span6">
                <input type="hidden" name="url" id="url" value="{{$url}}">
				<div class="control-group">
					<label class="control-label alignL">Sort By </label>
					<select id="sort" name="sort">
                        <option value="">Select</option>
						<option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected @endif>Latest Product</option>
						<option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected @endif>Product name A - Z</option>
						<option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected @endif>Product name Z - A</option>
						<option value="product_stoke" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_stoke') selected @endif>Product Stoke</option>
						<option value="product_lowest_price"@if(isset($_GET['sort']) && $_GET['sort'] == 'product_lowest_price') selected @endif >Price Lowest first</option>
						<option value="product_highest_price" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_highest_price') selected @endif>Price Highest first</option>
					</select>
				</div>
			</form>
			
			<br class="clr"/>
			<div class="tab-content ajax-product-listing">
                @include('front.products.ajax_product_listing');
			</div>
			<a href="compare.html" class="btn btn-large pull-right">Compare Product</a>
			<div class="pagination">
            @if(isset($_GET['sort']) && !empty($_GET['sort']))
            {{ $categoryProducts->appends(['sort'=>$_GET['sort']])->links('pagination::bootstrap-4') }}
            @else
            {{ $categoryProducts->links('pagination::bootstrap-4') }}
            @endif            
			</div>
			<br class="clr"/>
		</div>
@endsection