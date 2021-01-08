<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome' => 'required|min:2',
            'qtd_temporadas' => 'required',
            'ep_temporada' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'qtd_temporadas.required' => 'O campo temporadas é obrigatório',
            'ep_temporada.required' => 'O campo episodios é obrigatório',
            'nome.min' => 'O campo nome precisa ter pelo menos 2 caracteres'
        ];
    }
}
