<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ContentRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'content' => 'requirement'
            ];
    }

}
