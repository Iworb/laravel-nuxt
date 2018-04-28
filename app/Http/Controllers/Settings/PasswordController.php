<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class PasswordController extends Controller {
	/**
	 * Update the user's password.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
		Validator::extend('pwdvalidation', function($field, $value, $parameters) {
			return Hash::check($value, Auth::user()->password);
		});

		Validator::make($request->all(), [
			'oldPassword'           => 'required|pwdvalidation',
			'password'              => 'required|confirmed|min:1|max:50|different:oldPassword',
			'password_confirmation' => 'required',
		])->validate();

		$request->user()->update([
			'password' => bcrypt($request->password),
		]);
	}
}
