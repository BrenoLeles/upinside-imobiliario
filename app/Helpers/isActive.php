<?php

if(!function_exists('isActive')) {

	function isActive ($href, $class = 'active') {
		return $class = (strpos(\Illuminate\Support\Facades\Route::currentRouteName(), $href) === 0 ? $class : '');
	}
}