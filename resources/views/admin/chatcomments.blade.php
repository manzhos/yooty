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
                    @if ($comments->count() == 0)
                        <tr>
                            <td colspan="5">No comment to display.</td>
                        </tr>
                    @else
                        <div class="hidden">{{$comments->fresh()}}</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                                    <tr class="f-reg">
                                        <td class="col">{{$comment->body}}</td>
                                        <td class="col">{{$comment->user->name}}&nbsp;{{Str::substr($comment->user->surname, 0, 1)}}</td>
                                        <td class="col">
                                            {{$comment->message->subject}}
                                        </td>
                                        <td class="col">
                                            <!-- DELETE Message -->
                                            <a href="{{ route('del.comment',['comment_id' => $comment->id]) }}" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block;">Supprimer</a>
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
                    {{ $comments->links() }}
                </div>

            </div>
        </div>
    @endguest
@endsection
