@extends('layouts.app')

@section('content')
<body>
    <div id="app">
        <admin-dashboard :initial-products="{{ json_encode($products) }}"></admin-dashboard> 
    </div>
</body>
@endsection


