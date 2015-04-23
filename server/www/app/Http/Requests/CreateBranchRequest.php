<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\CommonRequestValidationRules;

class CreateBranchRequest extends Request {
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
            //branches
            'photo' => '',
            'request' => 'required',
            'rating' => '',
            'user_id' => '',
            'published' => '',
            'deleted' => '',
            'viewed' => '',
            'deleted_at' => '',
            'created_at' => 'required',
            'updated_at' => '',
            'name_us' => 'required',
            'name_ua' => '',
            'name_ru' => '',
            //branches_emails
            'email_priority' => '',
            'email' => '',
            //branches_sites
            'site_priority' => '',
            'site' => '',
            //branches_phones
            'phone_priority' => '',
            'phone' => '',
            'is_fax' => '',
            //branches_descriptions
            'description_us' => '',
            'about_us' => '',
            'description_ua' => '',
            'about_ua' => '',
            'description_ru' => '',
            'about_ru' => '',
            //branches_locations
            'city_id' => 'required_with:zip_id,address_us,address_ua,address_ru,latitude,longitude',
            'zip_id' => '',
            'address_us' => '',
            'address_ua' => '',
            'address_ru' => '',
            'latitude' => '',
            'longitude' => '',
            //branches_categories
            'category_id' => 'required_with:categories_secondary_id,categories_tertiary_id',
            'categories_secondary_id' => '',
            'categories_tertiary_id' => ''
        ]);
    }
}