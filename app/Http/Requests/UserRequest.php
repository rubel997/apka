<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'last_name' => 'required',
                        'phone_number' => '',
                        'street_id' => '',
                        'street' => '',
                        'house_number' => '',
                        'region_ids' => 'array|between:0,3',
                        'region' => '',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                        'role' => ''
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'last_name' => 'required',
                        'phone_number' => '',
                        'street_id' => '',
                        'street' => '',
                        'house_number' => '',
                        'region_ids' => 'array|between:0,3',
                        'region' => '',
                        'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
                        'password' => 'confirmed',
                        'role' => ''
                    ];
                }
            default:
                break;
        }
    }
}
