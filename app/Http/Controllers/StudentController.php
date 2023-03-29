<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\Student\ResourcesStudent;
use App\Http\Resources\Student\StudentCollection;
use App\Services\Repositories\StudentRepository;
use App\Traits\FileUploading;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentController extends Controller
{
    use FileUploading;
    protected $repository;

    public function __construct(StudentRepository $service)
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
        return new StudentCollection($this->repository->index());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Student\StoreStudentRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreStudentRequest $request)
    {
        $params = $request->validated();
        $params = $this->fileUploadind($params, $request, [
            'passport_document' => 'passports',
            'IELTS_document' => 'IELTS',
            'contract_document' => 'contracts'
        ]);
        $object = $this->repository->store($params);
        return new ResourcesStudent($object);
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
        return new ResourcesStudent($object);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Student\UpdateStudentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        if (!$id) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid id'
            ], 400));
        }

        $params = $request->validated();
        $params = $this->fileUploadind($params, $request, [
            'passport_document' => 'passports',
            'IELTS_document' => 'IELTS',
            'contract_document' => 'contracts'
        ]);
        $object = $this->repository->update($params, $id);
        return new ResourcesStudent($object);
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
        return new ResourcesStudent($object);
    }
}