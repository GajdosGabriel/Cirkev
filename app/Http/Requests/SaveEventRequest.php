<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'dateStart' => 'required|date|after:yesterday',
            'street' => 'required|max:250',
            'city' => 'required|max:250',
            'organizator' => 'required|max:250',
            'region' => 'required',
            'registration' => 'required',
            'entryFee' => 'required',
            'published' => 'required',
            'picture' => 'mimes:jpeg,jpg,png'
        ];
    }


    public function messages()
    {
        $messages = [
            'dateStart.required' => 'Dátum nesmie byť nižší ako dnešný.'
        ];

        return $messages;
    }
}
