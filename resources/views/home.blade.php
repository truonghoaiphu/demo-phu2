<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home Page</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <!-- Styles -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="http://cdnjs.clou   dflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container">
        <div class="row header">
            <div class="col-sm-6">
                <a href="<?= URL::to('/'); ?>">
                    <i class="fa fa-home"></i>
                    <h1 class="logo">Funny Movies</h1>
                </a>
            </div>
            <div class="col-sm-6 login">
                @auth
                    <div class="row">
                        <div class="col-sm-4"><span>Welcome, {{ auth()->user()->username }}</span></div>
                        <div class="col-sm-4">
                            <a href="{{ url('share') }}">{{ Form::submit('Share a movie') }}</a>
                        </div>
                        <div class="col-sm-4">
                            {{ Form::open(array('url' => 'logout')) }}
                            {{ Form::submit('Logout') }}
                            {{ Form::close() }}
                        </div>
                    </div>
                @endauth
                @guest
                    {{ Form::open(array('url' => 'login')) }}
                    {{ Form::text('username','', array('placeholder' => 'Username', 'required' => true)) }}
                    {{ Form::password('password', array('placeholder' => 'Password', 'required' => true)) }}
                    {{ Form::submit('Login / Register') }}
                    {{ Form::close() }}
                @endguest
                @if(isset ($errors) && count($errors) > 0)
                    <div class="alert alert-warning" role="alert">
                        <ul class="list-unstyled mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</header>
<section>
    @foreach($videos as $video)
        <div class="row" style="margin-top: 50px;">
            <div class="col-sm-6 text-right">
                <iframe width="300px" height="200px"
                        src="https://www.youtube.com/embed/{{$video->video_id}}">
                </iframe>
            </div>
            <div class="col-sm-6">
                <span class="text-bold" style="color: red;">{{ $video->title }}</span>
                @auth
                    @php
                        $resultReact = $video->reactionVideo($video->user_id, $video->id);
                    @endphp
                    @if ($resultReact)
                        @if ($resultReact->reaction == 'like')
                            <img src="{{ asset('images/thumbs_up.png') }}" width="30px">
                            <span>(voted up)</span>
                        @else
                            <img src="{{ asset('images/thumbs_down.png') }}" width="30px">
                            <span>(voted down)</span>
                        @endif
                    @else
                        <form method="POST" action="{{  url('react') }}" style="margin-top: -30px; margin-left: 400px;">
                            <button type="submit" class="button" style="border: unset; background: unset;" name="reaction" value="like"><img src="{{ asset('images/thumbs_up_light.png') }}" width="30px"></button>
                            <button type="submit" class="button" style="border: unset; background: unset;" name="reaction" value="dislike"><img src="{{ asset('images/thumbs_down_light.png') }}" width="30px"></button>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <input name="user_id" type="hidden" value="{{ $video->user_id }}">
                            <input name="share_video_id" type="hidden" value="{{ $video->id }}">
                            <span>(un-voted)</span>
                        </form>
                    @endif

                @endauth
                <br>
                <span class="text-left">Shared by: {{ $video->user->username }}</span>
                <br>
                <span>
                   {{ $video->getTotalReactionsAttribute('like') }} <img src="{{ asset('images/thumbs_up_light.png') }}" width="20px">
                </span>
                <span>
                   {{ $video->getTotalReactionsAttribute('dislike') }} <img src="{{ asset('images/thumbs_down_light.png') }}" width="20px">
                </span>
                <br>
                <span class="text-justify">Description: {{ $video->description }}</span>
            </div>
        </div>
    @endforeach
</section>
<footer></footer>
</body>
</html>
