<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMenuRequest extends FormRequest
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
        return [
            'nama_menu' => 'required',
            'harga' => 'required|integer',
            'file' => 'required_unless:file,null|image|mimes:jpg,jpeg,png',
            'kategori' => 'required'
        ];
    }
}