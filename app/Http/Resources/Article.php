<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id'          => $this->id,
			'user'        => $this->translate()->user->toArray()['name'],
			'slug'        => $this->slug,
			'title'       => $this->title,
			'description' => $this->description,
			'created_at'  => $this->created_at->timestamp,
			'updated_at'  => $this->updated_at->timestamp
		];
	}
}
