


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Merchant Data') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div><br />
                    @endif
                    <form method="POST" action="{{ route('merchantData.update', $merchantData->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Name') }}</label>

                            <div class="col-md-6">
                                <input id="merchant_name" type="text" class="form-control" name="merchant_name" value="{{ $merchantData->merchant_name }}" autocomplete="merchant_name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="merchant_image" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Image') }}</label>

                            <div class="col-md-6" style="display: inline-block;">
                                <input id="merchant_image" type="file" accept="image/*" class="form-control" name="merchant_image" value="{{ $merchantData->merchant_image }}" autofocus>
                            </div>
                            <img src="../../{{ $merchantData->merchant_image }}" style="width:36px;">
                        </div>

                        <div class="form-group row">
                            <label for="merchant_code" class="col-md-4 col-form-label text-md-right">{{ __('merchant_code') }}</label>
                            <div class="col-md-6">
                                <input id="merchant_code" type="text" class="form-control" name="merchant_code" value="{{ $merchantData->merchant_code }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="point_type" class="col-md-4 col-form-label text-md-right">{{ __('point_type') }}</label>
                            <div class="col-md-6">
                                <input id="point_type" type="text" class="form-control" name="point_type" value="{{ $merchantData->point_type }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $merchantData->description }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="loyalty_text" class="col-md-4 col-form-label text-md-right">{{ __('loyalty_text') }}</label>
                            <div class="col-md-6">
                                <input id="loyalty_text" type="text" class="form-control" name="loyalty_text" value="{{ $merchantData->loyalty_text }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="loyalty_icon" class="col-md-4 col-form-label text-md-right">{{ __('Loyalty Image') }}</label>

                            <div class="col-md-6" style="display: inline-block;">
                                <input id="loyalty_icon" type="file" accept="image/*" class="form-control" name="loyalty_icon" value="{{ $merchantData->loyalty_icon }}" autofocus>
                            </div>
                            <img src="../../{{ $merchantData->loyalty_icon }}" style="width:36px;">
                        </div>

                        <div class="form-group row">
                            <label for="food_type" class="col-md-4 col-form-label text-md-right">{{ __('Food Type') }}</label>
                            <div class="col-md-6">
                                <input id="food_type" type="text" class="form-control" name="food_type" value="{{ $merchantData->food_type }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="min_points_to_redeem" class="col-md-4 col-form-label text-md-right">{{ __('min_points_to_redeem') }}</label>
                            <div class="col-md-6">
                                <input id="min_points_to_redeem" type="number" class="form-control" name="min_points_to_redeem" value="{{ $merchantData->min_points_to_redeem }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
