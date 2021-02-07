@extends('yooty')

@section('content')

    <div class="container reg-container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="f-boldSE caps"> Conversations </h1>
                <div class="spacer40"></div>
            </div>
        </div>


        <div class="row">
            <!-- Subject of Messages -->
            <div class="col-md-4">
                @include('messages.messages-index')
            </div>

            <!-- List of Messages -->
            <div class="col-md-8">
                @include('messages.messages-list')
            </div>
            <!-- === Tempopary block like a content for messages === >>> <div class="col-md-7" style="height: 900px; width: 95%; padding-left: 5%; background-color: #f0f0f0;">&nbsp;</div> -->
        </div>
        <div class="spacer60"></div>

    </div>

@endsection
