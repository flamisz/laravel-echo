<div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $comment->creator->name }} said {{ $comment->created_at->diffForHumans() }}</div>

                <div class="panel-body">
                    {{ $comment->body }}
                </div>
            </div>
    </div>
</div>