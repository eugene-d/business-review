<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

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
        return [
            //branches
            'photo' => 'alpha_num|max:500|image',
            'request' => 'required|alpha_dash|max:255|unique:branches,request',
            'rating' => 'numeric|max:10',
            'user_id' => 'integer|max:10',
            'published' => 'boolean',
            'deleted' => 'boolean',
            'viewed' => 'integer|max:10',
            'deleted_at' => 'date_format:"Y-m-d H:i:s"',
            'created_at' => 'required|date_format:"Y-m-d H:i:s"',
            'updated_at' => 'date_format:"Y-m-d H:i:s"',
            'name_us' => 'required|alpha_dash|max:255|min:2',
            'name_ua' => 'alpha_dash|max:255|min:2',
            'name_ru' => 'alpha_dash|max:255|min:2',
            //branches_emails
            'email_priority' => 'integer|max:10',
            'email' => 'email|required_with:email_priority',
            //branches_sites
            'site_priority' => 'integer|max:10',
            'site' => 'url|required_with:site_priority',
            //branches_phones
            'phone_priority' => 'integer|max:10',
            'phone' => 'alpha_dash|max:15',
            'is_fax' => 'boolean',
            //branches_descriptions
            'description_us' => 'string|max:1024|required_with:about_us,description_ua,about_ua,description_ru,about_ru',
            'about_us' => 'string|max:1024',
            'description_ua' => 'string|max:1024',
            'about_ua' => 'string|max:1024',
            'description_ru' => 'string|max:1024',
            'about_ru' => 'string|max:1024',
            //branches_locations
            'city_id' => 'integer|max:10|required_with:zip_id,address_us,address_ua,address_ru,latitude,longitude',
            'zip_id' => 'integer|max:10',
            'address_us' => 'string|max:100',
            'address_ua' => 'string|max:100',
            'address_ru' => 'string|max:100',
            'latitude' => 'numeric|max:10',
            'longitude' => 'numeric|max:10',
            //branches_categories
            'category_id' => 'integer|max:10|required_with:categories_secondary_id,categories_tertiary_id',
            'categories_secondary_id' => 'integer|max:10',
            'categories_tertiary_id' => 'integer|max:10'
        ];
    }
}