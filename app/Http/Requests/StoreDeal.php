<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeal extends FormRequest
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

    protected function prepareForValidation()
    {
        if ($this->account_contact && $this->Contact_Name) {
            $this->merge([
                'Contact_Name' => null
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string,mixed>
     */
    public function rules()
    {
        return [
            'Deal_Name' => 'string|required|max:120',
            'Closing_Date' => 'required|after:now',
            'Stage' => 'string|required',
            'Account_Name' => 'numeric|required',
            'Contact_Name' => 'numeric|required_without:account_contact|nullable',
            'account_contact' => 'required_without:Contact_Name|nullable',
        ];
    }
}
