@extends('layouts.frontend.app')
@push('css')
@endpush
@section('title') আমাদের পণ্য @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1> আমাদের পণ্য</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / আমাদের পণ্য </p>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <select id="selectCat">
                        <option value="0">ক্যাটাগরি বাছাই </option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name_bn  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>


    <div class="container getproduct">

    </div>
    <div class="container allProduct">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="product">
                        <div class="img" style="background-image: url('{{asset('storage/products/'.$product->image)}}');"></div>
                        <div class="content">
                            <h3>{{ $product->title_bn }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 text-center">
                <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
            </div>
            <br><br><br><br><br><br>


        </div>
        <input type="hidden" value="1" name="area_id" id="area_id">
    </div>
@endsection
@push('js')
    <script>
        $(document).on("change", "#selectCat", function (e) {
            alert();
            let id=$(this).val();
            let area_id = $('#area_id').val();
            alert(area_id);
            let url = "{{url('/our-products')}}"+"/"+id+"/"+area_id
            $.ajax({
                type: "GET",
                url:url,
                success: function(data) {
                    $("div.getproduct").html(data);
                    $("div.allProduct").hide();
                }
            });
        });
    </script>
@endpush
