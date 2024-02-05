@extends('theme.layout')
@section('layout')


<section class="soliman-contcat-address">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <div class="soliman-contcat-address-item">
                    <h2>{{ __('site.address.headquarters') }}</h2>
                    <p>{!! render(@$set->address_headquarters->$lang) !!}</p>
                </div>
                <div class="soliman-contcat-address-item">
                    <h2>{{ __('site.address.dhahran') }}</h2>
                    <p>{!! render(@$set->address_dhahran->$lang) !!}</p>
                </div>
                <div class="soliman-contcat-address-item">
                    <h2>{{ __('site.address.medina') }}</h2>
                    <p>{!! render(@$set->address_medina->$lang) !!}</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="soliman-contcat-address-item2">
                    <h2>{{ __('site.address.phone') }}</h2>
                    <p><a href="tel:{{ @$set->phone}}">{{ @$set->phone}}</a></p>
                </div>
                <div class="soliman-contcat-address-item2">
                    <h2>{{ __('site.address.email') }}</h2>
                    <p><a href="mailto:{{ @$set->email}}">{{ @$set->email}}</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="soliman-contact" id="contact">
    <div class="container">
        <form class="contact-us-form" action="{{ route('contact.post') }}" method="POST">
            <h1>{{ __('site.contact.contact') }}</h1>
            <div class="row">
                <div class="soliman-alerts">
                    @if ($errors->any())
                    {!! implode('', $errors->all('<div class="soliman-alert soliman-alert-danger">:message</div>')) !!}
                    @endif
                    @if(session()->has('success'))
                    <div class="soliman-alert soliman-alert-success">{{session('success')}}</div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="soliman-contact-item">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('site.contact.name')  }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="soliman-contact-item">
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="{{ __('site.address.email')  }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="soliman-contact-item">
                        <textarea name="message" placeholder="{{ __('site.contact.message')  }}">{{ old('message') }}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="soliman-contact-item">
                        <button>{{ __('site.contact.send')  }}</button>
                        @csrf
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="soliman-map">
{!! @$set->map !!}
</section>


    @endsection
