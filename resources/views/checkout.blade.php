@extends('layouts.app')

@section('content')
<div id="app">
    <checkout>
        
    </checkout>
</div>
<script>
    window.stripePublicKey = "{{ env('STRIPE_KEY') }}";
</script>

@endsection

