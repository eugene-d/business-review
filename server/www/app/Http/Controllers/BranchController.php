<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Branch\CreateRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Requests\Branch\ShowRequest;
use App\Http\Requests\Branch\DeleteRequest;
use App\Models\Branches;
use App\Services\BranchService;

class BranchController extends Controller {
    private $defaultResponse = ['status' => 200, 'message' => 'Done.'];

    /**
     * Display a listing of the resource.
     * @param Branches $branches
     * @return Response
     */
    public function index(Branches $branches) {
        $this->defaultResponse['branches'] = $branches->orderBy('id', 'desc')->take(10)->get();
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateRequest $request
     * @param BranchService $branchService
     * @param Branches $branches
     * @return Response
     */
    public function store(CreateRequest $request, BranchService $branchService, Branches $branches) {
        $branchService->create($request->all(), $branches);
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Display the specified resource.
     * @param Branches $branches
     * @param ShowRequest $request
     * @return Response
     */
    public function show(Branches $branches, ShowRequest $request) {
        $this->defaultResponse['branch'] = $branches->find($request->get('id'));
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Update the specified resource in storage.
     * @param Branches $branches
     * @param UpdateRequest $request
     * @param BranchService $branchService
     * @return Response
     */
    public function update(Branches $branches, UpdateRequest $request, BranchService $branchService) {
        $branchService->update($request->all(), $branches);
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Remove the specified resource from storage.
     * @param Branches $branches
     * @param DeleteRequest $request
     * @return Response
     */
    public function destroy(Branches $branches, DeleteRequest $request) {
        $branches->find($request->get('id'))->delete();
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }
}