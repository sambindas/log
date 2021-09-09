<?php

use Illuminate\Support\Facades\Auth;


function currentUser() {
	if (\Illuminate\Support\Facades\Session::has('authUser')) {
		return (object)session()->get('authUser');
	}
	return false;
}

function sanitizeInput($posts_data, $exempted=[], $default_filter=FILTER_SANITIZE_STRING)
    {
        if (!is_array($posts_data)) {
            $posts_data = [$posts_data];
        }
        $args = array();
        foreach ($posts_data as $prk=>$prv) {
            if (!in_array($prk, array_keys($args))) {
                if (is_array($prv)) {
                    $args[$prk] = array(
                        'filter' => $default_filter,
                        'flags' => FILTER_REQUIRE_ARRAY,
                    );
                } else {
                    if (is_array($exempted) && in_array($prk, $exempted)) {
                        $args[$prk] = '';
                    } else {
                        $args[$prk] = FILTER_SANITIZE_STRING;
                    }
                }
            }
        }
        return filter_var_array($posts_data, $args);
    }

?>