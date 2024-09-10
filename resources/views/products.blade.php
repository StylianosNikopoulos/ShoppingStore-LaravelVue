@extends('layouts.app')

@section('content')
<div id="app">
    <!-- Mount Vue component here -->
    <products :initial-products="{{ json_encode($products) }}"></products>
</div>
@endsection