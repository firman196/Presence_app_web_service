<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;

class AdminUpdateRequest extends FormRequest
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
        $ids = \Crypt::decrypt($this->id);
        return [
            'nik'                => 'required|unique:dosens,nik,'.$ids.',nik|numeric|digits:16',
            'nip'                => 'required|min:3|max:25',
            'nama'               => 'required|max:50',
            'foto'               => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'oldfoto'            => 'nullable|string',
            'email'              => 'required|email|unique:dosens,email,'.$ids.',nik',
            'password'           => 'required|min:6', 
            'status'             => 'required'
        ];
    }

    /**
     * 
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $validator->errors(),
            ],'Validasi Error', 401)
        );
    }
}
