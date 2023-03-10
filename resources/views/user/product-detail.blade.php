@extends('user.component.main')

@section('content')
    <div class="container mt-5">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index-2.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->categories->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                {{ $product->name }}
            </span>
        </div>
    </div>

    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                            <div class="slick3 gallery-lb">
                                @foreach ($product->products_images as $img)
                                    <div class="item-slick3" data-thumb="{{ $img->url }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $img->url }}" alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ $img->url }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h4>

                        <div class="tab01">

                            <ul class="nav nav-tabs justify-content-start" role="tablist">

                                @foreach ($product->products_variants as $index => $pv)
                                    <li class="nav-item p-b-10" onclick="tabChange({{$pv->id}})">
                                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab"
                                            href="#{{ $index }}" role="tab">{{ $pv->name }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content p-t-10">
                                @foreach ($product->products_variants as $index => $pv)
                                    <div class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                        id="{{ $index }}" role="tabpanel">
                                        <div class="how-pos2">
                                            <b>Price</b> : @money($pv->price)
                                        </div>

                                    
                                    </div>
                                @endforeach
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" id="quantity" value="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button
                                            onclick="addToCart()"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="bor10 m-t-50 p-t-43 p-b-40">

                <div class="tab01">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                    </ul>

                    <div class="tab-content p-t-43">

                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: JAK-01
            </span>
            <span class="stext-107 cl6 p-lr-25">
                Categories: Jacket, Men
            </span>
        </div>
    </section>

    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($relatedProducts as $rp)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ $rp->products_images[0]->url }}" alt="IMG-PRODUCT">
                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Quick View
                                </a>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $rp->name }}
                                    </a>
                                    <span class="stext-105 cl3">
                                        @money($rp->products_variants[0]->price)
                                    </span>
                                </div>
                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="{{ asset('front_assets/images/icons/icon-heart-01.png') }}"
                                            alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="{{ asset('front_assets/images/icons/icon-heart-02.png') }}" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://unpkg.com/axios@1.2.1/dist/axios.min.js"></script>
    <script>
        
        let pvId = `{{ $product->products_variants[0]->id }}`;
        function tabChange(id){
            pvId = id;
        }
        function addToCart(){
            let q =  $('#quantity').val();
            axios.post(`{{ route('addToCart') }}`, {
                products_variants_id : pvId,
                quantity : q,
            }).then(function(res){
                console.log(res)
            }).catch(function(err){
                console.log(err);
            }).finally(function(){
                alert('process end');
            })
        }
    </script>
@endsection