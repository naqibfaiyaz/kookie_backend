@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped"> 
        <thead class="table-dark">
            <tr>
                <td>Sl No</td>
                <td>Merchant Name</td>
                <td>Marchent Image</td>
                <td>Merchant Code</td>
                <td>Point Type</td>
                <td>Description</td>
                <td>Loyalty Text</td>
                <td>Loyalty Icon</td>
                <td>Food Type</td>
                <td>Min Points To Redeem</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($merchantData as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->merchant_name }}</td>
                    <td><img src="{{ $data->merchant_image }}" style="width: 64px;"></td>
                    <td>{{ $data->merchant_code }}</td>
                    <td>{{ $data->point_type }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->loyalty_text }}</td>
                    <td><img src="{{ $data->loyalty_icon }}" style="width: 24px;"></td>
                    <td>{{ $data->food_type }}</td>
                    <td>{{ $data->min_points_to_redeem }}</td>
                    <td><a href="{{ route('merchantData.edit', $data->id) }}" class="btn btn-primary">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection