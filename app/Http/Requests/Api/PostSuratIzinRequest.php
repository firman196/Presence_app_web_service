<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PostSuratIzinRequest extends FormRequest
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
            'kode_jenis_izin'       => 'required|string|max:5',
            'nim'                   => 'required|string|max:15',
            'presensi_id'           => 'required|numeric',
            'judul_surat_izin'      => 'required|string|max:255',
            'keterangan_mahasiswa'  => 'required|string',
            'foto_surat_izin'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
