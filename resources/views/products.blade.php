@extends('layouts.app')

@section('content')
<div id="app">
    <products :initial-products="{{ json_encode($products) }}"></products>
</div>
@endsection