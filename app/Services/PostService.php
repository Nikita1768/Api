<?php

namespace App\Services;

use App\DTO\PostData;
use App\Enums\PostStatusEnum;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostShowResource;
use App\Models\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class PostService
{
    public function __construct(
        protected PostRepository $repository,
        protected UserRepository $userRepository
    )
    {
    }

    public function create(PostData $postData): JsonResponse
    {
        $post = $this->repository->create($postData);
        return response()->json(PostShowResource::make($post), 201);
    }

    public function getAll(): JsonResponse
    {
        $posts = $this->repository->getAllPosts();
        return response()->json(PostCollection::make($posts));
    }

    public function getById(int $id): JsonResponse
    {
        $post = $this->repository->getById($id);
        return response()->json(PostResource::make($post));
    }


    public function update(PostData $postData): JsonResponse
    {
        $post = $this->repository->updateById($postData);
        return response()->json(PostResource::make($post));
    }

    public function delete(int $id): JsonResponse
    {
        $post = $this->repository->deleteById($id);
        return response()->json(PostResource::make($post));
    }

    public function activate(int $id): JsonResponse
    {
        if (auth()->user()->hasActivePlan()) {
            $post = $this->repository->activate($id);
            $publications = $this->userRepository->decrementPublication();
            return response()->json(PostResource::make($post)->resolve() +
                ['publications_lasts' => $publications]);
        }
        return response()->json(['Message' => 'You dont have active plan.'], 403);
    }
}
