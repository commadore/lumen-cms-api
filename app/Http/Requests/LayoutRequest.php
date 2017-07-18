<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class LayoutRequest extends Request
{
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => 'required'
            ];
    }

}
