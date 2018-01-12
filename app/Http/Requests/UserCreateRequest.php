<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seatReserve' => 'required|number|min:1',
            'firstName' => 'required',
            'email' => 'required|email|max:255',
//            'iamHuman' => 'required|integer|between:5,5',
        ];
    }

    public function messages()
    {
        $messages = [
            'firstName.required' => 'Zadajte svoje meno!',
            'seatReserve.required' => 'Neuviedli ste počer miest!',
            'email.required' => 'Neuviedli ste správny email!',
        ];

        return $messages;
    }
}
