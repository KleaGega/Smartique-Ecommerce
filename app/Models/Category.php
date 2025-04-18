<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	public $timestamps = true;
	protected $fillable = ['name'];
	protected $dates = ['deleted_at'];

	public function products(): HasMany
	{
		return $this->hasMany(Product::class, 'category_id', 'id');
	}
}
