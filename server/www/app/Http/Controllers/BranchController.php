<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateBranchRequest;
use App\Http\Requests\ShowDeleteBranchRequest;
use App\Models\Branches;
use App\Services\CreateBranchService;

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
     * @param CreateBranchRequest $request
     * @param CreateBranchService $createBranchService
     * @param Branches $branches
     * @return Response
     */
    public function store(CreateBranchRequest $request, CreateBranchService $createBranchService, Branches $branches) {
        $createBranchService->create($request->all(), $branches);
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Display the specified resource.
     * @param Branches $branches
     * @param ShowDeleteBranchRequest $request
     * @return Response
     */
    public function show(Branches $branches, ShowDeleteBranchRequest $request) {
        $this->defaultResponse['branch'] = $branches->find($request->get('id'));
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @return Response
     */
    public function update($id) {
        $this->defaultResponse['message'] = 'Update the specified resource in storage.';
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }

    /**
     * Remove the specified resource from storage.
     * @param Branches $branches
     * @param ShowDeleteBranchRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Branches $branches, ShowDeleteBranchRequest $request) {
        $branches->find($request->get('id'))->delete();
        return response()->json($this->defaultResponse, $this->defaultResponse['status']);
    }
}