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
            'site' => 'required',
            'route' => 'required',
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
            'footer' => 'required',
            'published' => 'required'
            ];
    }

}
