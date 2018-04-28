<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model {
	use Sluggable;
	use FullTextSearch;

	protected $fillable = ['title', 'slug', 'description', 'body'];
	protected $searchable = ['title', 'description', 'body'];

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source'    => 'title',
				'maxLength' => 255
			]
		];
	}

	public function user() {
		return $this->belongsTo(User::class, 'user_id');
	}
}
