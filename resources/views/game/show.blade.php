@extends('layouts.app')

@push('styles')
<style>
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    .refresh {
        animation: rotate 1.5s linear infinite;
    }
</style>
@endpush

@section('content')
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Game') }}</div>

                    <div class="card-body">
                        <div class="text-center">
                            <img id="circle" class="refresh" src="{{ asset('img/circle.png') }}" alt="image"
                                height="250" width="250">
                            <p id="winner" class="display-1 d-none text-primary"></p>
                            <hr/>

                            <div class="text-center">
                                <label for="user_bet" class="fw-bold h5">{{ __('Your Bet') }}</label>
                                <select name="user_bet" id="user_bet" class="form-control d-inline w-25">
                                    <option selected>Not in</option>
                                    @foreach(range(1, 12) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                                <hr/>
                                <p class="fw-bold h5">Remaining Time</p>
                                <p id="timer" class="h5 text-danger">Waiting to start</p>
                                <hr/>
                                <p id="result" class="h1"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
