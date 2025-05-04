<div class="row">
    @foreach($products as $product)
    <div class="col-md-4">
        <div class="product">
            <div class="img" data-fancybox="" data-caption="{{ $product->title_bn }}" href="{{asset('storage/products/'.$product->image)}}" style="background-image: url('{{asset('storage/products/'.$product->image)}}');"></div>
            <div class="content">
                <h5>{{ $product->title_bn }}</h5>
                <h6>মূল্য: {{ $product->price }}</h6>
            </div>
        </div>
    </div>
    @endforeach
<!--
    <div class="col-md-12 text-center">
        <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
    </div>
-->
    <br><br><br><br><br><br>


</div>
