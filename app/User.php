<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'genre',
		'document',
		'document_secondary',
		'document_secondary_complement',
		'date_of_birth',
		'place_of_birth',
		'civil_status',
		'cover',
		'occupation',
		'income',
		'company_work',
		'zipcode',
		'street',
		'number',
		'complement',
		'neighborhood',
		'state',
		'city',
		'telephone',
		'cell',
		'type_of_communion',
		'spouse_name',
		'spouse_genre',
		'spouse_document',
		'spouse_document_secondary',
		'spouse_document_secondary_complement',
		'spouse_date_of_birth',
		'spouse_place_of_birth',
		'spouse_occupation',
		'spouse_income',
		'spouse_company_work',
		'lessor',
		'lessee',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function setLessorAttribute($valor)
	{
		$this->attributes['lessor'] = ($valor === true || $valor === 'on' ? 1 : 0);
	}

	public function setLesseeAttribute($valor)
	{
		$this->attributes['lessee'] = ($valor === true || $valor === 'on' ? 1 : 0);
	}

	public function setDocumentAttribute($valor)
	{
		$this->attributes['document'] = $this->clearField($valor);
	}

	public function setDateOfBirthAttribute($valor)
	{
		$this->attributes['date_of_birth'] = $this->convertStringToDate($valor);
	}

	public function setIncomeAttribute($valor)
	{
		$this->attributes['income'] = floatval($this->convertStringToDouble($valor));
	}

	public function setZipcodeAttribute($valor)
	{
		$this->attributes['zipcode'] = $this->clearField($valor);
	}

	public function setTelephoneAttribute($valor)
	{
		$this->attributes['telephone'] = $this->clearField($valor);
	}

	public function setCellAttribute($valor)
	{
		$this->attributes['cell'] = $this->clearField($valor);
	}

	public function setPasswordAttribute($valor)
	{
		$this->attributes['password'] = bcrypt($valor);
	}

	public function setSpouseDocumentAttribute($valor)
	{
		$this->attributes['spouse_document'] = $this->clearField($valor);
	}

	public function setSpouseDateOfBirthAttribute($valor)
	{
		$this->attributes['spouse_date_of_birth'] = $this->convertStringToDate($valor);
	}

	public function setSpouseIncomeAttribute($valor)
	{
		$this->attributes['spouse_income'] = floatval($this->convertStringToDouble($valor));
	}


	private function clearField(?string $param)
	{
		if (empty($param)) {
			return '';
		}
		return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
	}

	private function convertStringToDate(?string $param)
	{
		if (empty($param)) {
			return null;
		}
		list($day, $month, $year) = explode('/', $param);
		return (new \DateTime($year . '-' . $month .'-' . $day))->format('Y-m-d');
	}

	private function convertStringToDouble(?string $param)
	{
		if (empty($param)) {
			return null;
		}

		if(strpos($param, ',')){
			$param = str_replace("R$","",$param);
			$param = str_replace(".","",$param);
			$param = str_replace(",",".",$param);
			$param = str_replace(" ","",$param);
			$param = preg_replace('/[^0-9.]/', '', $param);
		}
		return $param;
	}
}
