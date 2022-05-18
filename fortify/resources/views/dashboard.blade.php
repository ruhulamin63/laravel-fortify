@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
{{--                        @if (session('success'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ session('success') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @if(! auth()->user()->two_factor_secret)
                            You have not enable 2-factor.
                            <form action="{{ url('user/two-factor-authentication') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enable</button>
                            </form>
                        @else
                            You have 2-factor enable.
                            <form action="{{ url('user/two-factor-authentication') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Disable</button>
                            </form>
                        @endif

                        @if(session('status') == 'two-factor-authentication-enable')
                            <p>You have now enabled 2-factor, please scan the following QR code
                            into your phone authentication application.</p>
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}

                            <p>Please store theses recovery</p>
                            @foreach(json_decode(decrypt(auth()->user()->tow_factor_recovery_codes, true)) as $code)
                                {{ trim($code) }} <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
