<?php namespace App\Http\Requests\Branch;

class UpdateRequest extends CreateRequest {
    /**
     * This constructor make small changes to CreateRequest customValidationRules
     */
    public function __construct() {
        parent::__construct();
        $this->customValidationRules['id'] = 'required';
        $this->customValidationRules['request'] = 'required';
        $this->customValidationRules['created_at'] = '';
    }
}