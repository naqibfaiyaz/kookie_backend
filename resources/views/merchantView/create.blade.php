@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Merchant Data') }}</div>

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
                    <form method="POST" action="{{ route('merchantData.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Name') }}</label>

                            <div class="col-md-6">
                                <input id="merchant_name" type="text" class="form-control" name="merchant_name"  autocomplete="merchant_name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="merchant_image" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Image') }}</label>

                            <div class="col-md-6" style="display: inline-block;">
                                <input id="merchant_image" type="file" accept="image/*" class="form-control" name="merchant_image" autofocus onchange="readURL(this, 'merchant');">
                            </div>
                            <img id="merchant_img" style="width:36px;">
                            <small class="my-auto mx-auto text-danger">Only PNG</small>
                        </div>

                        <div class="form-group row">
                            <label for="point_type" class="col-md-4 col-form-label text-md-right">{{ __('point_type') }}</label>
                            <div class="col-md-6">
                                <input id="point_type" type="text" class="form-control" name="point_type">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="loyalty_text" class="col-md-4 col-form-label text-md-right">{{ __('loyalty_text') }}</label>
                            <div class="col-md-6">
                                <input id="loyalty_text" type="text" class="form-control" name="loyalty_text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="loyalty_icon" class="col-md-4 col-form-label text-md-right">{{ __('Loyalty Image') }}</label>

                            <div class="col-md-6" style="display: inline-block;">
                                <input id="loyalty_icon" type="file" accept="image/*" class="form-control" name="loyalty_icon" autofocus onchange="readURL(this, 'loyalty');">
                            </div>
                            <img id="loyalty_img" style="width:36px;">
                            <small class="my-auto mx-auto text-danger">Only PNG</small>
                        </div>

                        <div class="form-group row">
                            <label for="food_type" class="col-md-4 col-form-label text-md-right">{{ __('Food Type') }}</label>
                            <div class="col-md-6">
                                <input id="food_type" type="text" class="form-control" name="food_type">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="min_points_to_redeem" class="col-md-4 col-form-label text-md-right">{{ __('min_points_to_redeem') }}</label>
                            <div class="col-md-6">
                                <input id="min_points_to_redeem" type="number" class="form-control" name="min_points_to_redeem">
                            </div>
                        </div>
                        
                        <div class="form-group" id="redeem_offers">
                            <label for="offerings_for_redeem" class="col-md-4 offset-md-1 col-form-label text-md-left">{{ __('Offers to redeem') }}</label>
                            <label for="min_points_to_redeem_offer" class="col-md-5 col-form-label text-md-right">{{ __('Min Points required') }}</label>
                            <div class="repeat">
                                <div class="input-group col-md-11">
                                    <div class="col-md-1 my-auto">
                                        1
                                    </div>

                                    <input id="offerings_for_redeem" type="text" class="form-control mx-1 col-md-8" name="offerings_for_redeem[]">
                                    <input id="min_points_to_redeem_offer" type="text" class="form-control mx-1 col-md-2" name="min_points_to_redeem_offer[]">
                                </div>
                            </div>
                            <div class="container float-right my-auto mx-4" style="position: relative; text-align: end;" onclick="add_redeem_row();">
                                <img src="../images/icons/plus.png" style="width:16px; height: 16px;" >
                                <div style="margin-right: -20px;">Add More</div>
                            </div>
                        </div>

                        <div class="form-group float-right my-5">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Merchant') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
     function readURL(input, img_type) {
         console.log(img_type);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + img_type + '_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function add_redeem_row(){
        nex_row_no=$('#redeem_offers .input-group').length+1;
        console.log($('#redeem_offers .input-group').length);
        html_row=' <div class="input-group col-md-11">' + 
                    '<div class="col-md-1 my-auto">' +
                        nex_row_no +
                    '</div>' +
                    '<input id="offerings_for_redeem" type="text" class="form-control mx-1 col-md-8" name="offerings_for_redeem[]">' +
                    '<input id="min_points_to_redeem_offer" type="text" class="form-control mx-1 col-md-2" name="min_points_to_redeem_offer[]">' + 
                '</div>';

        $('#redeem_offers .repeat').append(html_row);
    }
</script>
@endsection
