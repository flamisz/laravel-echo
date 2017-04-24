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

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Comments</h3>
        </div>
    </div>

    @if (auth()->check())
        <comment-form article-id="{{ $article->id }}"></comment-form>
    @else
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                Please <a href="{{ route('login') }}">login</a> to create comment.
            </div>
        </div>
    @endif

    <comment-list article="{{ $article->slug }}"></comment-list>
</div>
@endsection