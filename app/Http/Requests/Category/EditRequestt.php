<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditRequestt extends FormRequest
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
        //رقم المستخدم المنوي التعديل عليه
        $id = $this->route('Announcement');
        return [
            'text'=>'required|unique:announcements,text,' . $id . ',id'
        ];
    }
}
