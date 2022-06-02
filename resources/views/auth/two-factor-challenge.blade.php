@extends('layout')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Confirm your password</div>

                        <div class="card-body">

                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <p>Please enter your authentication code to login.</p>
                            <form action="{{ url('/two-factor-challenge') }}" method="POST">
                                @csrf

                                <input type="text" name="code" />
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </form>

                            <p>Enter your recovery code.</p>
                            <form action="{{ url('/two-factor-challenge') }}" method="POST">
                                @csrf

                                <input type="text" name="recovery_code" />
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
