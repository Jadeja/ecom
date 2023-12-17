
<div class="tab-pane  active" id="blockView">
<ul class="thumbnails">
    @foreach($categoryProducts as $key =>$value)
    <li class="span3">
        <div class="thumbnail">
            <a href="{{url('/product/'.$value['id'])}}">
            <?php 
            $image="";
            if(!empty($value['main_image']) && file_exists(public_path('images/product_images/small/'.$value['main_image']))){
                $image= asset('images/product_images/small/'.$value['main_image']);

            }else{
                $image= asset('images/product_images/small/no-image.png');
            } ?>
            <img src="{{ $image }}" alt=""/></a>
            <div class="caption">
                <h5>{{$value['product_name']}}</h5>
                <h5>{{$value['product_price']}}</h5>
                <p>
                    {{$value['brand']['name']}}
                </p>
                                <p>
                    {{$value['fabric']}}
                </p>
                <h4 style="text-align:center"><a class="btn" href="{{url('/product/'.$value['id'])}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
            </div>
        </div>
    </li>
    @endforeach
</ul>
<hr class="soft"/>
</div>