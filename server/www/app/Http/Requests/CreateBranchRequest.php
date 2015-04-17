<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBranchRequest extends Request {

    /**
     * The URI to redirect to if validation fails
     *
     * @var string
     */
    protected $redirect = 'branch/denied';

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
            'email' => 'email',
            //branches_sites
            'site_priority' => 'integer|max:10',
            'site' => 'url',
            //branches_phones
            'phone_priority' => 'integer|max:10',
            'phone' => 'alpha_dash|max:15',
            'is_fax' => 'boolean',
            //branches_descriptions
            'description_us' => 'string|max:1024',
            'about_us' => 'string|max:1024',
            'description_ua' => 'string|max:1024',
            'about_ua' => 'string|max:1024',
            'description_ru' => 'string|max:1024',
            'about_ru' => 'string|max:1024',
        ];
    }
}