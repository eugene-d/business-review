<?php namespace App\Http\Requests\Branch;

use App\Http\Requests\Request;

class ShowRequest extends Request {
    protected $customValidationRules = ['id' => 'required'];
}