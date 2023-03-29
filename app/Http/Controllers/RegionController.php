<?php

namespace App\Http\Controllers;

use App\Http\Requests\Region\StoreRegionRequest;
use App\Http\Requests\Region\UpdateRegionRequest;
use App\Http\Resources\Region\RegionCollection;
use App\Http\Resources\Region\ResourcesRegion;
use App\Services\Repositories\RegionRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegionController extends Controller
{
    protected $repository;

    public function __construct(RegionRepository $service)
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
        return new RegionCollection($this->repository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Region\StoreRegionRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreRegionRequest $request)
    {
        $params = $request->validated();
        $object = $this->repository->store($params);
        return new ResourcesRegion($object);
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
        return new ResourcesRegion($object);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Region\UpdateRegionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $params = $request->validated();
        $object = $this->repository->update($params, $id);
        return new ResourcesRegion($object);
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
        return new ResourcesRegion($object);
    }
}