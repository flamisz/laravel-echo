@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article->title }}</div>

                    <div class="panel-body">
                        {{ $article->body }}
                    </div>
                </div>
        </div>
    </div>
<comment-list article="{{ $article->slug }}"></comment-list>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Comments</h3>
        </div>
    </div>

    @if (auth()->check())
        @include('comments.create')
    @else
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                Please <a href="{{ route('login') }}">login</a> to create comment.
            </div>
        </div>
    @endif

    @foreach ($article->comments as $comment)
        @include('comments.show')
    @endforeach
</div>
@endsection