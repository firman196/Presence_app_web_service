<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaAcaraUpdateRequest extends FormRequest
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
            'tanggal_pertemuan'     => 'required|date',
            'materi_perkuliahan'    => 'required|string',
            'media_perkuliahan'     => 'nullable|string',
            'catatan_perkuliahan'   => 'nullable|string'
        ];
    }
}
