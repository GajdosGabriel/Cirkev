<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200',
            'body' => 'required|spamDetection',
            'user_id' => 'exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'video_link' => 'max:250',
            'picture' => 'mimes:jpeg,bmp,png,JPG,JPEG|max:10250'
        ];
    }

}
