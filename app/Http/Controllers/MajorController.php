<?php

namespace App\Http\Controllers;

use App\Http\Requests\Major\StoreMajorRequest;
use App\Http\Requests\Major\UpdateMajorRequest;
use App\Http\Resources\Major\MajorCollection;
use App\Http\Resources\Major\ResourcesMajor;
use App\Services\Repositories\MajorRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class MajorController extends Controller
{

    protected $repository;

    public function __construct(MajorRepository $service)
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
        return new MajorCollection($this->repository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Major\StoreMajorRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreMajorRequest $request)
    {
        $params = $request->validated();
        $object = $this->repository->store($params);
        return new ResourcesMajor($object);
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
        return new ResourcesMajor($object);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Major\UpdateMajorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateMajorRequest $request, $id)
    {

        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $params = $request->validated();
        $object = $this->repository->update($params, $id);
        return new ResourcesMajor($object);
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
        return new ResourcesMajor($object);
    }
}