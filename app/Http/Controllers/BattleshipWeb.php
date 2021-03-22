<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BattleshipWeb extends Controller {

    function index(Request $request) {

        if (isset($_SESSION['battleField'])) {
            $data = $_SESSION['battleField'];
        } else {
            return \App::call('App\Http\Controllers\BattleshipApi@newgame');
            $data = $_SESSION['battleField'];
        }
        $field = array_chunk($data, 10, true);

        return view('index')->with('data', $field);
    }

}
