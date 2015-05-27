<?php namespace App\Http\Requests\Branch;

use App\Http\Requests\Request;

class CreateRequest extends Request {
    protected $customValidationRules = [
        //branches
        'photo' => '',
        'request' => 'required|unique:branches,request',
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
        'email' => '',
        //branches_sites
        'site' => '',
        //branches_phones
        'phone' => '',
        //branches_descriptions
        'description_us' => '',
        'about_us' => '',
        'description_ua' => '',
        'about_ua' => '',
        'description_ru' => '',
        'about_ru' => '',
        //branches_locations
        'city_id' => '',
        'zip_id' => '',
        'address_us' => '',
        'address_ua' => '',
        'address_ru' => '',
        'latitude' => '',
        'longitude' => '',
        //branches_categories
        'category_id' => '',
        'categories_secondary_id' => '',
        'categories_tertiary_id' => ''
    ];
}