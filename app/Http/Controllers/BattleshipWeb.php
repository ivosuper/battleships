<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BattleshipApi;
use App\BattleshipModel;

class BattleshipWeb extends Controller {
   
    
      function index(Request $request, BattleshipApi $BattleshipApi) {

        if (isset($_SESSION['battleField'])) {
            $data = $_SESSION['battleField'];
            
        } else {
  
            $BattleshipApi->newgame();
            $data = $_SESSION['battleField'];
            
        }
        $field = array_chunk($data, 10, true);

        return view('index')->with('data', $field);
    }

}
