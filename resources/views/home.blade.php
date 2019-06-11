@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Live Chat</div>

                <div class="card-body" id="app">
                    <live-chat :user="{{auth()->user()}}"></live-chat>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
