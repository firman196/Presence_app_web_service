<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;

class BeaconUpdateRequest extends FormRequest
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
            'kode_beacon' => 'required|unique:beacons,kode_beacon,'.$ids.',kode_beacon|string|max:10',
            'kode_ruang'  => 'required|string|max:10',
            'uuid'        => 'required',
            'major'       => 'required|numeric',
            'minor'       => 'required|numeric'
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
