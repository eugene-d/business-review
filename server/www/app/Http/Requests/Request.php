<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;


abstract class Request extends FormRequest {
    /**
     * override Illuminate\Foundation\Http\FormRequest
     * Custom realization of response method to avoid redirect and always return JSON response object
     * @param array $errors
     * @return $this|JsonResponse
     */
    public function response(array $errors) {
        $statusCode = 422;
        return new JsonResponse(['status' => $statusCode, 'errors' => $errors], $statusCode);
    }
}