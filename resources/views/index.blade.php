@extends('layout.page')

@section('content')
    <x-radar manifest="radarnl-observations.json" />
    <div class="row uneven">
        <x-warnings.small />
    </div>
@endsection
