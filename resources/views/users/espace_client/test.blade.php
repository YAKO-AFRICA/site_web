@extends('users.espace_client.layouts.main')

@section('content')

    <div class="container">
        <p class="text-center m-5">
             <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
        </p>
    </div>
@endsection