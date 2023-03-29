<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\ResourcesUser;
use App\Http\Resources\User\UserCollection;
use App\Services\Repositories\UserRepository;
use App\Traits\FileUploading;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    use FileUploading;
    protected $repository;

    public function __construct(UserRepository $service)
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
        return new UserCollection($this->repository->index());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreUserRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreUserRequest $request)
    {
        $params = $request->validated();
        $params = $this->fileUploadind($params, $request, [
            'photo' => 'avatars',
        ]);
        $object = $this->repository->store($params);
        return new ResourcesUser($object);
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
        return new ResourcesUser($object);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $params = $request->validated();
        $params = $this->fileUploadind($params, $request, [
            'photo' => 'avatars',
        ]);
        $object = $this->repository->update($params, $id);
        return new ResourcesUser($object);
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
        return new ResourcesUser($object);
    }
}