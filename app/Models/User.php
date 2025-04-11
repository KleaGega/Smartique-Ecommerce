<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Relations\HasMany, SoftDeletes};

class User extends Model
{
	use SoftDeletes;

	public $timestamps = true;
	protected $dates = ['deleted_at'];
	protected $fillable = ['username', 'fullname', 'email', 'password', 'address', 'role', 'city','phone','postal_code'];

	public function orders(): HasMany
	{
		return $this->hasMany(Order::class);
	}
}
