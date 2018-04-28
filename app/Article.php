<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	use Translatable;

	public $timestamps = false;

	public $translatedAttributes = [
		'user_id',
		'title',
		'slug',
		'description',
		'body',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	protected $fillable = ['user_id', 'title', 'slug', 'description', 'body'];
}
