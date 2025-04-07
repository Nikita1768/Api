<?php

namespace App\Repository;

use App\DTO\PostData;
use App\Enums\PostStatusEnum;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository
{
    const PER_PAGE = 8;

    public function create(PostData $postData): Post
    {
        return Post::create($postData->toArray());
    }

    public function getAllPosts(): LengthAwarePaginator
    {
        return Post::query()
            ->where('status', PostStatusEnum::ACTIVE->value)
            ->paginate(self::PER_PAGE);
    }

    public function getById(int $id) : Post
    {
        return Post::query()
            ->findOrFail($id);
    }

    public function updateById(PostData $postData): Post
    {
        Post::where('id', $postData->id)->update($postData->toArray());
        return $this->getById($postData->id);
    }

    public function deleteById(int $id): Post
    {
        $post = $this->getById($id);
        $post->delete();
        return $post;
    }

    public function activate(int $id): Post
    {
        $post = $this->getById($id);
        $post->update(['status' => PostStatusEnum::ACTIVE]);
        return $post;
    }

    public function getByAuthUser(): LengthAwarePaginator
    {
        return Post::query()
            ->where('user_id', auth()->id())
            ->paginate(self::PER_PAGE);
    }
}
