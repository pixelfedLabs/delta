<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Pixelfed\Snowflake\HasSnowflakePrimary;

class DomainVerification extends Model
{
	use HasSnowflakePrimary;

	/**
	* Indicates if the IDs are auto-incrementing.
	*
	* @var bool
	*/
	public $incrementing = false;
}
