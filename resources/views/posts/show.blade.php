<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">&larr; Back</a>
    </div>

    <h1 class="text-primary">{{ $post->title }}</h1>
    <p class="text-secondary">{{ $post->content }}</p>

    <h2 class="mt-4">Comments</h2>
    @foreach ($post->comments as $comment)
        <div class="card my-3">
            <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>
            </div>
            @foreach ($comment->replies as $reply)
                <div class="card mx-4 my-2">
                    <div class="card-body bg-light">
                        <p class="card-text">{{ $reply->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <h3 class="mt-4">Add Comment</h3>
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="form-control" rows="4" placeholder="Write your comment..." required></textarea>
        </div>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="parent_comment_id" value="{{ old('parent_comment_id') }}">
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
