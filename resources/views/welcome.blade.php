@extends('layouts')

@session('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Sign Up</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.gete',Sign up now!,[],['class' => btn btn-lg btn-primary]) !!}
        </div>
    </div>    
@endsection
