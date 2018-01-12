<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMessengersRequest extends FormRequest
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
        if(auth()->guest()) {
            return[
                'iamHuman' => 'required|in:5',
                'email' => 'required|email',
                'body' => 'required|min:3',
                'name' => 'required|min:3',
            ];
        }
        return [
            //
        ];
    }

}
