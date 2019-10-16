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
                    <form method="POST" action="{{ route('merchantData.update', $merchantData->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input id="merchant_id" value={{ $merchantData->id }} hidden>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Name') }}</label>

                            <div class="col-md-6">
                                <input id="merchant_name" type="text" class="form-control" name="merchant_name" value="{{ $merchantData->merchant_name }}" autocomplete="merchant_name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="merchant_image" class="col-md-4 col-form-label text-md-right">{{ __('Merchant Image') }}</label>

                            <div class="col-md-6" style="display: inline-block;">
                                <input id="merchant_image" type="file" accept="image/*" class="form-control" name="merchant_image" value="{{ $merchantData->merchant_image }}" autofocus onchange="readURL(this, 'merchant');">
                            </div>
                            <img id="merchant_img" src="../../{{ $merchantData->merchant_image }}" style="width:36px;">
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
                                <input id="loyalty_icon" type="file" accept="image/*" class="form-control" name="loyalty_icon" value="{{ $merchantData->loyalty_icon }}" autofocus onchange="readURL(this, 'loyalty');">
                            </div>
                            <img id="loyalty_img" src="../../{{ $merchantData->loyalty_icon }}" style="width:36px;">
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

                            
                            <div class="form-group" id="redeem_offers">
                                <label for="offerings_for_redeem" class="col-md-4 offset-md-1 col-form-label text-md-left">{{ __('Offers to redeem') }}</label>
                                <label for="min_points_to_redeem_offer" class="col-md-5 col-form-label text-md-right">{{ __('Min Points required') }}</label>
                                <div class="repeat">
                                    @foreach($merchantOffers as $key=>$offer)
                                        <div class="input-group col-md-11 offer-group-{{ $key }}">
                                            <div class="col-md-1 my-auto">
                                                {{ $key+1 }}
                                            </div>
        
                                            <input id="offerings_for_redeem" type="text" class="form-control mx-1 col-md-8" name="offerings_for_redeem[]" value={{ $offer['offerings_for_redeem'] }}>
                                            <input id="min_points_to_redeem_offer" type="text" class="form-control mx-1 col-md-2" name="min_points_to_redeem_offer[]" value={{ $offer['min_points_to_redeem_offer'] }}>
                                            
                                            <img src="../../images/icons/minus.png" class="my-auto mx-4" style="width:16px; height: 21px;" onclick="remove_redeem_row({{ $key }})">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="container float-right my-auto mx-4" style="position: relative; text-align: end;" onclick="add_redeem_row();">
                                    <img src="../../images/icons/plus.png" style="width:16px; height: 16px;" >
                                    <div style="margin-right: -20px;">Add More</div>
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

   function remove_redeem_row(id){
    classId='#redeem_offers .offer-group-' + id ;
    offerings_for_redeem = $(classId + ' #offerings_for_redeem').val();
    merchant_code = $('#merchant_code').val();

    $(classId).remove();

    deleteOffers();
       
    //    html_row=' <div class="input-group col-md-11">' + 
    //                '<div class="col-md-1 my-auto">' +
    //                    nex_row_no +
    //                '</div>' +
    //                '<input id="offerings_for_redeem" type="text" class="form-control mx-1 col-md-8" name="offerings_for_redeem[]">' +
    //                '<input id="min_points_to_redeem_offer" type="text" class="form-control mx-1 col-md-2" name="min_points_to_redeem_offer[]">' + 
    //            '</div>';

    //    $('#redeem_offers .repeat').append(html_row);
   }

   async function deleteOffers() {
        try {
            const res = await axios.delete(
                'http://192.168.10.10/merchantData/' + $('#merchant_id').val(),
                {
                    headers: {
                        'X-CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        'merchant_code': merchant_code,
                        'offerings_for_redeem': offerings_for_redeem
                    }
                }
            );
            console.log(res.status);
        } catch (err) {
            console.error(err);
        }
    };
</script>
@endsection
