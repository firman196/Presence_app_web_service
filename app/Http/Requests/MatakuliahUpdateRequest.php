<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseFormatter;
class MatakuliahUpdateRequest extends FormRequest
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
            'kode_matakuliah'                => 'required|max:15|unique:matakuliah,kode_matakuliah,'.$ids.',kode_matakuliah',
            'nama_matakuliah'                => 'required|max:50',
            'sifat_matakuliah'               => 'required',
            'jenis_matakuliah'               => 'required',
            'sks'                            => 'required|numeric',
            'kode_prodi'                     => 'required|max:10',
            'semester'                       => 'required|numeric'
        ];
    }
}
