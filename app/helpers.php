<?php

use Illuminate\Support\Facades\Auth;


function currentUser() {
	if (\Illuminate\Support\Facades\Session::has('authUser')) {
		return (object)session()->get('authUser');
	}
	return false;
}

?>