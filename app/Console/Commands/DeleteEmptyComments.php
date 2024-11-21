<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class DeleteEmptyComments extends Command
{
    protected $signature = 'comments:delete-empty';
    protected $description = 'Delete comments with empty content';

    public function handle()
    {
        Comment::whereNull('content')->orWhere('content', '')->delete();
        $this->info('Empty comments deleted successfully.');
    }


}
