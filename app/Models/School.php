<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	protected $fillable = [
		'ru_name',
		'en_name',
	];
}
