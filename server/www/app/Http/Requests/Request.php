<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest {
    private $responseErrorCode = 422;
    protected $commonValidationRules = [
        //branches
        'photo' => 'alpha_num|max:500|image',
        'request' => 'alpha_dash|max:255',
        'rating' => 'numeric|max:5',
        'user_id' => 'integer',
        'published' => 'boolean',
        'deleted' => 'boolean',
        'viewed' => 'integer',
        'deleted_at' => 'date_format:"Y-m-d H:i:s"',
        'created_at' => 'date_format:"Y-m-d H:i:s"',
        'updated_at' => 'date_format:"Y-m-d H:i:s"',
        'name_us' => 'alpha_dash|max:255|min:2',
        'name_ua' => 'alpha_dash|max:255|min:2',
        'name_ru' => 'alpha_dash|max:255|min:2',
        'id' => 'integer',
        //branches_emails
        'email' => 'email',
        //branches_sites
        'site' => 'url',
        //branches_phones
        'phone' => 'alpha_dash',
        //branches_descriptions
        'description_us' => 'string|max:1024|required_with:about_us,description_ua,about_ua,description_ru,about_ru',
        'about_us' => 'string|max:1024',
        'description_ua' => 'string|max:1024',
        'about_ua' => 'string|max:1024',
        'description_ru' => 'string|max:1024',
        'about_ru' => 'string|max:1024',
        //branches_locations
        'city_id' => 'integer|required_with:zip_id,address_us,address_ua,address_ru,latitude,longitude',
        'zip_id' => 'integer',
        'address_us' => 'string|max:100',
        'address_ua' => 'string|max:100',
        'address_ru' => 'string|max:100',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
        //branches_categories
        'category_id' => 'integer|required_with:categories_secondary_id,categories_tertiary_id',
        'categories_secondary_id' => 'integer',
        'categories_tertiary_id' => 'integer'
    ];

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules() {
        return $this->combineWithCommon($this->customValidationRules);
    }

    /**
     * Get the validation rules that apply to the request.
     * @param $customRules
     * @return mixed
     */
    protected function combineWithCommon($customRules) {
        foreach ($customRules as $field => $customRule) {
            if(array_key_exists($field, $this->commonValidationRules)) {
                $customRules[$field] = $this->commonValidationRules[$field]
                    . (($customRule === '')? '' : '|' . $customRule);
            }
        }
        return $customRules;
    }

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Custom realization of response method to avoid redirect and always return JSON response object
     * @param array $errors
     * @return $this|JsonResponse
     */
    public function response(array $errors) {
        return new JsonResponse(['status' => $this->responseErrorCode, 'errors' => $errors], $this->responseErrorCode);
    }
}