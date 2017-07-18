<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class PageRequest extends Request
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
            'route' => 'required',
            'name' => 'required',
            'layout' => 'required',
            ];
    }

}
