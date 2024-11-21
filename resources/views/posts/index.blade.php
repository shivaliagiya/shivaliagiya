<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body>
<h1 class="text-center">Posts</h1>
<div class="container">
    @foreach ($posts as $post)
        <div class="post">
            <h2>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </h2>
            <p>{{ $post->content }}</p>
        </div>
    @endforeach
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
