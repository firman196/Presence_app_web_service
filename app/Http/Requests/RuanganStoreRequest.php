<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;

class RuanganStoreRequest extends FormRequest
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
            'kode_ruang'                => 'required|unique:ruangan,kode_ruang|max:10',
            'nama_ruang'                => 'required|max:25',
            'kapasitas_ruang_kuliah'    => 'required|numeric',
            'kapasitas_ruang_ujian'     => 'required|numeric',
            'kode_prodi'                => 'required|max:10',
            'nama_gedung'               => 'required|max:25'
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
