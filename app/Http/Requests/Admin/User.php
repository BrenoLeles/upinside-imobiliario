<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|min:3|max:191',
			'genre' =>'in:male,female,other',
//			'document' =>'required|min:11|max:14|unique:users',
			'document_secondary' => 'required|min:8|max:12',
			'document_secondary_complement' =>'required',
			'date_of_birth' => 'required|date_format:d/m/Y',
			'place_of_birth' => 'required',
			'civil_status' =>'required|in:married,separated,single,divorced,widower',

			// Income
			'occupation' => 'required',
			'income' => 'required',
			'company_work' => 'required',

			// Address
			'zipcode' =>'required|min:8|max:9',
			'street' => 'required',
			'number' => 'required',
			'neighborhood' => 'required',
			'state' => 'required',
			'city' => 'required',

			// contact
			'cell' => 'required',

			// Access
//			'email' => 'required|email|unique:users',

			// Spouse
			'type_of_communion' =>'required_if:civil_state,married,separated|in:Comunhão Universal de Bens,Comunhão Parcial de Bens,Separação Total de Bens,Participação Final de Aquestos',
			'spouse_name' => 'required_if:civil_state,married,separated|min:3|max:191',
			'spouse_genre' =>'in:male,female,other',
			'spouse_document' =>'required_if:civil_state,married,separated|min:11|max:14',
			'spouse_document_secondary' => 'required_if:civil_state,married,separated|min:8|max:12',
			'spouse_document_secondary_complement' =>'required',
			'spouse_date_of_birth' => 'required_if:civil_state,married,separated|date_format:d/m/Y',
			'spouse_place_of_birth' => 'required_if:civil_state,married,separated',
			'spouse_occupation' => 'required_if:civil_state,married,separated',
			'spouse_income' => 'required_if:civil_state,married,separated',
			'spouse_company_work' => 'required_if:civil_state,married,separated',
		];
	}
}
