<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;
class MahasiswaUpdateRequest extends FormRequest
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
            'nim'           => 'required|string|unique:mahasiswas,nim,'.$ids.',nim',
            'nama'          => 'required',
            'kode_prodi'    => 'required',
            'kelas_id'      => 'required',
            'semester'      => 'required',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'oldfoto'       => 'nullable|string',
            'telp'          => 'required',
            'email'         => 'required',
            'dosen'         => 'nullable',
            'status'        => 'required'
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
