<?php namespace App\Http\Requests\Branch;

use App\Http\Requests\Request;
use App\Http\Requests\CommonRequestValidationRules;

class ShowDeleteRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $commonRules = new CommonRequestValidationRules();
        return $commonRules->mergeWithCustom([
            'id' => 'required'
        ]);
    }
}