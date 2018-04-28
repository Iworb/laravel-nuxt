<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$per_page = 10;
		$q        = $request->query();
		if (array_key_exists('per_page', $q) && ctype_digit($q['per_page']) && intval($q['per_page']) > 0) {
			$per_page = intval($q['per_page']);
		}
		$articles = Article::with('translations.user')->paginate($per_page);

		return ArticleResource::collection($articles);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Article $article
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Article $article) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Article $article
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Article $article) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Article             $article
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Article $article) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Article $article
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Article $article) {
		//
	}
}
