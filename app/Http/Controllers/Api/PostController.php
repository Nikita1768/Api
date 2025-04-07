<?php

namespace App\Http\Controllers\Api;
use App\DTO\PostData;
use App\Http\Requests\Post\ActivateRequest;
use App\Http\Requests\Post\IdRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class PostController extends \Illuminate\Routing\Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService
    )
    {}

    public function getAll(): JsonResponse
    {
        return $this->postService->getAll();
    }

    public function activate(ActivateRequest $request): JsonResponse
    {
        return $this->postService->activate($request->id);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->userService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $postData = new PostData(...$request->validated());
        return $this->postService->create($postData);
    }

    /**
     * Display the specified resource.
     */
    public function show(IdRequest $request): JsonResponse
    {
        return $this->postService->getById($request->id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $postData = new PostData(...$request->validated());
        return $this->postService->update($postData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IdRequest $request): JsonResponse
    {
        return $this->postService->delete($request->post);
    }

}
