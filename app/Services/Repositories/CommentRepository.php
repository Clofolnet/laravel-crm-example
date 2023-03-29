<?php

namespace App\Services\Repositories;

use App\Services\Repositories\BaseRepository;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $comment)
    {
        $this->entity = $comment;
    }
}