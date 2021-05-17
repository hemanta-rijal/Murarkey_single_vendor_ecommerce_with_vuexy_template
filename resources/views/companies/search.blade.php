@extends('layouts.search')

@section('title')
  {{ request('search') }} Suppliers - Kabmart
@endsection

@section('sub-content')

    <div class="tab_filter_box p-t-25">
        <div class="row">
            <div class="col-md-12">
                <div class="box_one supplier" style="display: block;">
                    <div class="col-md-2 col-sm-4 col-xs-6">

                        <p class="p-r-12">Quick Filters: </p>
                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <label class="fancy-checkbox">
                            <input type="checkbox"
                                   onclick="clickLink('?{{ http_build_query(array_merge(request()->except('page', 'skype'), request('skype') ? [] : ['skype' => 1])) }}')" {{ request('skype') ? 'checked' :'' }}>
                            <span><img src="/assets/img/skype.png" alt="" class="media_filter">Skype</span>
                        </label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <label class="fancy-checkbox">
                            <input type="checkbox"
                                   onclick="clickLink('?{{ http_build_query(array_merge(request()->except('page', 'viber'), request('viber') ? [] : ['viber' => 1])) }}')" {{ request('viber') ? 'checked' :'' }}>
                            <span><img src="/assets/img/viber.png" alt="" class="media_filter">Viber</span>
                        </label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">

                        <label class="fancy-checkbox">
                            <input type="checkbox"
                                   onclick="clickLink('?{{ http_build_query(array_merge(request()->except('page', 'whatsapp'), request('whatsapp') ? [] : ['whatsapp' => 1])) }}')" {{ request('whatsapp') ? 'checked' :'' }}>
                            <span style="margin-right: 0;"><img src="/assets/img/whatsapp.png" alt=""
                                                                class="media_filter">Whatsapp</span>
                        </label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">

                        <label class="fancy-checkbox">
                            <input type="checkbox"
                                   onclick="clickLink('?{{ http_build_query(array_merge(request()->except('page', 'wechat'), request('wechat') ? [] : ['wechat' => 1])) }}')" {{ request('wechat') ? 'checked' :'' }}>
                            <span><img src="/assets/img/wechat.png" alt="" class="media_filter">WeChat</span>
                        </label>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @if($companies->count() > 0)
        <div class="tab_filter_box p-0" id="supplierwala">

            @foreach($companies as $company)
                <div class="row bottom_border hover_effect m-0">
                    <div class="col-md-7">
                        <a href="{{ route('companies.show', $company->slug) }}"><h4
                                    class="titlewala p-13">{{ $company->name }}</h4></a>
                        <div class="row m-0 p-l-10">
                            @foreach($company->featured_products->take(4) as $product)
                                <div class="col-md-3 p-0">
                                    <div class="supplier_item">
                                        <a href="{{ route('products.show', $product->slug) }}" class="color_inherit"><img
                                                    src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                    alt="{{ $product->name }}"
                                                    class="img-responsive">
                                            <div class="detailing">
                                                <p>{{ $product->name }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="right_block p-t-41">
                            <div class="">
                                <p class="black m-b-0"><span class="dim">Main Products: </span>{{ $company->products }}
                                </p>
                                <p class="black m-b-0"><span class="dim">Business Type: </span>
                                    {{ $company->formated_business_type }}</p>
                                <p class="black m-b-0"><span
                                            class="dim">Location: </span> {{ $company->city_obj->name }},
                                    {{ $company->province_obj->name }}, {{ $company->country->name }}</p>
                            </div>
                            <div class="hhh">

                                <a href="{{ route('companies.contact', $company->slug) }}" class="btn btn-default m-b-15">Contact
                                    Info</a>
                                <div class="bottom_wid_drop flex-start p-r-30">

                                    @if($company->owner->seller->wechat)
                                        <div class="dropup" id="drop_a">
                                            <a class="btn dropdown-toggle" type="button" id="dropdownMenu2"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <img src="/assets/img/wechat.png" alt=""
                                                     class="dropup_trigger"></a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <li><img src="/assets/img/wechat.png"
                                                         alt="">{{ $company->owner->seller->wechat }}
                                                    <button class="btn"
                                                            onclick="copy_it('{{ $company->owner->seller->wechat }}')">
                                                        Copy ID
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                    @if($company->owner->seller->viber)
                                        <div class="dropup" id="drop_b">
                                            <a class="btn dropdown-toggle" type="button" id="dropdownMenu3"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <img src="/assets/img/viber.png" alt=""
                                                     class="dropup_trigger"></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                                <li><img src="/assets/img/viber.png"
                                                         alt="">{{ $company->owner->seller->viber }}
                                                    <button class="btn"
                                                            onclick="copy_it('{{ $company->owner->seller->viber }}')">
                                                        Copy ID
                                                    </button>
                                                </li>

                                            </ul>

                                        </div>
                                    @endif

                                    @if($company->owner->seller->skype)
                                        <div class="dropup" id="drop_c">
                                            <a class="btn dropdown-toggle" type="button" id="dropdownMenu4"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <img src="/assets/img/skype.png" alt=""
                                                     class="dropup_trigger"></a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                                                <li><img src="/assets/img/skype.png"
                                                         alt="">{{ $company->owner->seller->skype }}
                                                    <button class="btn"
                                                            onclick="copy_it('{{ $company->owner->seller->skype }}')">
                                                        Copy ID
                                                    </button>
                                                </li>

                                            </ul>

                                        </div>
                                    @endif


                                    @if($company->owner->seller->whatsapp)
                                        <div class="dropup" id="drop_d">
                                            <a class="btn dropdown-toggle" type="button" id="dropdownMenu4"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <img src="/assets/img/whatsapp.png" alt=""
                                                     class="dropup_trigger"></a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                                                <li><img src="/assets/img/whatsapp.png"
                                                         alt=""> {{ $company->owner->seller->whatsapp }}
                                                    <button class="btn"
                                                            onclick="copy_it('{{ $company->owner->seller->whatsapp }}')">
                                                        Copy ID
                                                    </button>
                                                </li>
                                            </ul>

                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="no_results">
            No results found. Please try your search again
        </div>
    @endif
    {!! $companies->appends(request()->all())->links('partials.search-pagination') !!}
@endsection