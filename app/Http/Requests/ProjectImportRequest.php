<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectImportRequest extends FormRequest
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
        $rules = ['file' => 'required'];

        if($this->type == "mail") {
          $rules['name'] = 'required|string|max:255|unique:projects';
        }
        return $rules;
    }

    public function getValidatorInstance()
    {

        if ($this->session()->has('projectName')) {
          $this->merge(['name' => $this->session()->get('projectName')]);
        }

        return parent::getValidatorInstance();
    }
}
