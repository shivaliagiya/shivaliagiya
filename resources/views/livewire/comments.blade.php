<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        <div class="card my-3">
            <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>
                @if ($comment->depth < $depthLimit)
                    <button wire:click="$set('parentCommentId', {{ $comment->id }})" class="btn btn-link">Reply</button>
                @endif
            </div>

            @if ($comment->replies)
                <div class="ms-4">
                    @foreach ($comment->replies as $reply)
                        @include('livewire.comment-reply', ['reply' => $reply])
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

    <h3 class="mt-4">Add Comment</h3>
    <form wire:submit.prevent="addComment({{ $parentCommentId }})" class="mt-3">
        <div class="mb-3">
            <textarea wire:model="content" class="form-control" rows="4" placeholder="Write your comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>
