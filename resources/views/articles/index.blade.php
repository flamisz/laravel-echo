@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($articles as $article)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article->title }}</div>

                    <div class="panel-body">
                        {{ $article->body }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection