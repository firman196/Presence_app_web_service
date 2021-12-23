<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;

class JadwalUpdateRequest extends FormRequest
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
            'kode_jadwal'               => 'required|unique:jadwals,kode_jadwal,'.$ids.',kode_jadwal',
            'kode_matakuliah'           => 'required|max:15',
            'dosen'                     => 'required|max:25',
            'jam_mulai'                 => 'required',
            'jam_selesai'               => 'required',
            'kelas_id'                  => 'required',
            'kode_ruang'                => 'required',
            'hari_id'                   => 'required|max:25'
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
