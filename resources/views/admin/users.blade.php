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
                    <h2 class="f-boldSE caps">Dashboard / Users</h2>
                </div>

                <div class="spacer20">&nbsp;</div>

                <div class="container">
                    @if ($users->count() == 0)
                        <tr>
                            <td colspan="5">No user to display.</td>
                        </tr>
                    @else
                        <div class="hidden">{{$users->fresh()}}</div>
{{--
                        <div class="f-14">Sort by <a href="#" class="underline">Name</a> <a href="#" class="underline">Surname</a> <a href="#" class="underline">Role</a></div>
                        <div class="spacer10">&nbsp;</div>
--}}

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">id</th>
                                <th scope="col">Role</th>
                                <th scope="col">Admin/User</th>
                                <th scope="col">Set&nbsp;Admin</th>
                                <th scope="col">Blocked</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="f-reg">
                                        <td class="col"><a href="{{ route('profiles.publicprofile', ['id' => $user->id]) }}" class="black">{{$user->name}} {{$user->surname}}</a></td>
                                        <td class="col">{{$user->id}}</td>
                                        <td class="col">
                                            @if($user->meta)
                                                @if($user->meta->prof === 'yes')
                                                    <span class="f-reg">Prof.</span>
                                                @else
                                                    <span class="f-reg">Student</span>
                                                @endif
                                            @else
                                                <span class="f-reg">Student</span>
                                            @endif
                                        </td>
                                        <td class="col">
                                            <span class="f-reg">{{ $user->role->role }}</span>
                                        </td>
                                        <td class="col">
                                            @if($user->role->role === 'admin')
                                                <form action="{{ route('admin.setroleuser', ['user_id' => $user->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="blank-button greenok"><i class="fas fa-check-circle"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.setroleadmin', ['user_id' => $user->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="blank-button grayok"><i class="fas fa-check-circle"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="col">
                                            @if($user->role->blocked)
                                                <form action="{{ route('admin.unblockuser', ['user_id' => $user->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="blank-button greenok"><i class="fas fa-check-circle"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.blockuser', ['user_id' => $user->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="blank-button grayok"><i class="fas fa-check-circle"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="col">
                                            <!-- DELETE User -->
                                            <a href="{{ route('admin.delusers',['user_id' => $user->id]) }}" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block;">Supprimer</a>
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

                        <div class="row">
                            <div class="col">
                                <hr/>
                                <!-- Clear trash in user DB -->
                                <a href="{{ route('admin.cleardb') }}" class="yooty-del-BTN yooty-btn-link yooty-BTN-comment" style="display:inline-block;">Clear user DB</a>
                            </div>
                        </div>

                    @endif
                </div>

                <div class="spacer20">&nbsp;</div>

                <!-- Pagination links -->
                <div>
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    @endguest
@endsection
