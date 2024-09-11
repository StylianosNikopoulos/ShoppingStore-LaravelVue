@extends('layouts.app')

@section('content')
<body>
    <div id="app">
        <admin-update :edit-product="{{ json_encode($product) }}"></admin-update> 
    </div>
</body>
@endsection


