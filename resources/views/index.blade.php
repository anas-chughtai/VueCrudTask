@extends('layouts.master')
@section('title', 'Home')
@section('styles')
    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="">
                <a class="btn btn-primary btn-lg" href="{{ route('inquiries.index') }}">INQUIRIES</a>
            </div>
        </div>
    </div>
@endsection
