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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|min:3',
                    'loginid' => 'required|unique:users,loginid',
                    'password' => 'required|between:3,32',
                    'password_confirm' => 'required|same:password',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|min:3',
                    'type' => 'required|min:3',
                    'loginid' => 'required|unique:users,loginid,' . $this->user->id,
                    'password_confirm' => 'sometimes|same:password',
                ];
            }
            default:
                break;
        }

        return [

        ];
    }
}
