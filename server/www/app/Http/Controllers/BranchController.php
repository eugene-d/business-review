<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateBranchRequest;
use App\Services\CreateBranchService;
use App\Models\Branches;

class BranchController extends Controller {
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(CreateBranchRequest $request, CreateBranchService $createBranchService, Branches $branches) {
        var_dump($request->all());
        $createBranchService->create($request->all(), $branches);
        return 'Display a listing of the resource.';
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateBranchRequest $request
     * @param CreateBranchService $createBranchService
     * @param Branches $branches
     * @return string
     */
    public function store(CreateBranchRequest $request, CreateBranchService $createBranchService, Branches $branches) {
        $createBranchService->create($request->all(), $branches);
        return 'Store a newly created resource in storage.';
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @return Response
     */
    public function update($id) {
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        return 'destroy';
    }

    /**
     * Return some response when Validation is false.
     * @deprecated remove after testing
     * @return Response
     */
    public function denied() {
        echo "<pre> Old Input data: <hr>";
        var_dump(old());
        echo "</br></br> Error messages: <hr>";
        $errors = session()->get('errors');
        var_dump(($errors) ? $errors->all() : '');
    }
}