<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Services\Repositories\CommentRepository;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\ResourcesComment;
use Illuminate\Http\Exceptions\HttpResponseException;


class CommentController extends Controller
{

    protected $repository;

    public function __construct(CommentRepository $service)
    {
        $this->repository = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        return new CommentCollection($this->repository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Comment\StoreCommentRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreCommentRequest $request)
    {
        $params = $request->validated();
        $object = $this->repository->store($params);
        return new ResourcesComment($object);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $object = $this->repository->show($id);
        return new ResourcesComment($object);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Comment\UpdateCommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $params = $request->validated();
        $object = $this->repository->update($params, $id);
        return new ResourcesComment($object);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy($id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $object = $this->repository->destroy($id);
        return new ResourcesComment($object);

    }
}