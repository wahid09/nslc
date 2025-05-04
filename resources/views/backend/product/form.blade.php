@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-cart-plus icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($product) ? 'Edit' : 'Create'}} Product</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.products.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($product) ? route('app.products.update', $product->id) : route('app.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($product)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control @error('category') is-invalid @enderror catSelect" name="category" required autofocus>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id}}" @isset($product)
                                                    {{($product->categorie_id == $category->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $category->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select id="area" class="form-control @error('area') is-invalid @enderror areaSelect" name="area" required autofocus>
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($product)
                                                    {{($product->area_id == $area->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $area->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('area')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">Product title(Bangla) *</label>
                                    <input id="title_bn" type="text" class="form-control @error('title_bn') is-invalid @enderror" name="title_bn" value="{{ $product->title_bn ?? old('title_bn') }}" required autocomplete="title_bn" autofocus placeholder="পণ্যের নাম">

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input id="avatar" type="file" class="dropify form-control @error('image') is-invalid @enderror" name="image" @isset($product) data-default-file="{{asset('storage/products/'.$product->image)}}" @endisset>
                                    <span>Image size will be: 368 X 349</span>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Product Price *</label>
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price ?? old('price') }}" required autocomplete="price" autofocus placeholder="">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="discount">Product Discount(%) *</label>
                                    <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $product->discount ?? old('discount') }}" required autocomplete="discount" autofocus placeholder="">

                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($product) {{ $product->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($program)
                                        <i class="fas fa-arrow-circle-up"></i>&nbsp;Update</button>
                                @else
                                    <i class="fas fa-plus-circle"></i>&nbsp;Create</button>
                                @endisset


                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.catSelect').select2({
                placeholder: "Select Category",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
        });
    </script>

@endpush
