<?php

namespace App\Http\Requests;

use com\zoho\crm\api\record\Record;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string,mixed>
     */
    public function rules()
    {
        return [
            'First_Name' => 'nullable|string|max:40',
            'Last_Name' => 'string|max:40',
            'new_account' => 'new_account|nullable|string|max:100',
            'existed_account' => 'existed_account|nullable|numeric',
        ];
    }

    public function withValidator($validator)
    {
        $validator->addExtension('new_account', function ($attribute, $value, $parameters, $validator) {
            return !(data_get($validator->getData(), 'existed_account'));
        });

        $validator->addExtension('existed_account', function ($attribute, $value, $parameters, $validator) {
            return !(data_get($validator->getData(), 'new_account'));
        });

        $validator->addReplacer('new_account', function ($message, $attribute, $rule, $parameters, $validator) {
            return 'You can`t fill account name and select existed';
        });

        $validator->addReplacer('existed_account', function ($message, $attribute, $rule, $parameters, $validator) {
            return 'You can`t select existed account and fill name for new one';
        });
    }
}
