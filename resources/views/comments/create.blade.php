<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create a Comment</div>

            <div class="panel-body">
                <form method="POST" action="/comments">
                    {{ csrf_field() }}

                    <input type="hidden" name="article_id" value="{{ $article->id }}">

                    <div class="form-group">
                        <label for="body">Comment:</label>
                        <input type="text" class="form-control" id="body" name="body"
                               value="{{ old('body') }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>

                    @if (count($errors))
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>