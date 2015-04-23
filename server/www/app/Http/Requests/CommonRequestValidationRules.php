<?php namespace App\Http\Requests;

class CommonRequestValidationRules {
    private $commonValidationRules = [
        //branches
        'photo' => 'alpha_num|max:500|image',
        'request' => 'alpha_dash|max:255|unique:branches,request',
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
        'email_priority' => 'integer',
        'email' => 'email|required_with:email_priority',
        //branches_sites
        'site_priority' => 'integer',
        'site' => 'url|required_with:site_priority',
        //branches_phones
        'phone_priority' => 'integer',
        'phone' => 'alpha_dash',
        'is_fax' => 'boolean',
        //branches_descriptions
        'description_us' => 'string|max:1024|required_with:about_us,description_ua,about_ua,description_ru,about_ru',
        'about_us' => 'string|max:1024',
        'description_ua' => 'string|max:1024',
        'about_ua' => 'string|max:1024',
        'description_ru' => 'string|max:1024',
        'about_ru' => 'string|max:1024',
        //branches_locations
        'city_id' => 'integer',
        'zip_id' => 'integer',
        'address_us' => 'string|max:100',
        'address_ua' => 'string|max:100',
        'address_ru' => 'string|max:100',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
        //branches_categories
        'category_id' => 'integer',
        'categories_secondary_id' => 'integer',
        'categories_tertiary_id' => 'integer'
    ];

    /**
     * Get the validation rules that apply to the request.
     * @param $customRules
     * @return mixed
     */
    public function mergeWithCustom($customRules) {
        foreach ($customRules as $field => $customRule) {
            if(array_key_exists($field, $this->commonValidationRules)) {
                $customRules[$field] = $this->commonValidationRules[$field]
                    . (($customRule === '')? '' : '|' . $customRule);
            }
        }

        return $customRules;
    }
}