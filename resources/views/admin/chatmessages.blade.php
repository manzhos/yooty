@extends('admin.layouts.yooty-admin')

@section('content')
    @guest
        <div class="container text-center">
            <div class="admin-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                        <br />
                        <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container admin-container">
            <div class="row">
                <div class="col">
                    <h2 class="f-boldSE caps">Dashboard / Messages</h2>
                </div>

                <div class="spacer20">&nbsp;</div>

                <div class="container">
                    @if ($messages->count() == 0)
                        <tr>
                            <td colspan="5">No message to display.</td>
                        </tr>
                    @else
                        <div class="hidden">{{$messages->fresh()}}</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Message</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Chat&nbsp;for&nbsp;message</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr class="f-reg">
                                        <td class="col"><a href="{{route('messages.show', ['id' => $message->id])}}" class="black">{{$message->subject}}</a></td>
                                        <td class="col">{{$message->user->name}}&nbsp;{{Str::substr($message->user->surname, 0, 1)}}</td>
                                        <td class="col">
                                            @if(optional($message->meta)->terminate)
                                                <span class="red-txt">Terminate</span>
                                            @else
                                                <span class="green-txt">Open</span>
                                            @endif
                                        </td>
                                        <td class="col">
                                            <!-- DELETE Message -->
                                            <a href="{{ route('message.delete',['message_id' => $message->id]) }}" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block;">Supprimer</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr/>

                        <div class="spacer40">&nbsp;</div>

                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-10">
                                @include('layouts.partials.error')
                                @include('layouts.partials.success')
                                @include('layouts.partials.error-message')
                            </div>
                            <div class="col-md-1">&nbsp;</div>
                        </div>

{{--
                        <div class="row">
                            <div class="col">
                                <hr/>
                                <!-- Clear trash in message DB -->
                                <a href="{{ route('admin.cleardb') }}" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block;">Clear user DB</a>
                            </div>
                        </div>
--}}

                    @endif
                </div>

                <div class="spacer20">&nbsp;</div>

                <!-- Pagination links -->
                <div>
                    {{ $messages->links() }}
                </div>

            </div>
        </div>
    @endguest
@endsection
