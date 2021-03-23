<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BattleshipModel;
use Session;


class BattleshipApi extends Controller {

    public $ships = [5, 4, 4];
    public $battleField;
    
    public function handle() {
        return response()->json(['message' => 'Page Not Found. 404'], 404);
    }


    public function shot(Request $cordinates ) {
        
    
        
        if(isset($cordinates->x)&& isset($cordinates->y)){
            $x = $cordinates->x;
            $y = $cordinates->y;
            
        } else {
            return ['message' => 'This request to the API is not in right format.'];
        }

      
            
        

        if (isset($_SESSION["battleField"])) {
            
            $this->battleField = session('battleField');
            $this->battleField = $_SESSION["battleField"];
        } else {
            $this->crateBattleField();

            $_SESSION["battleField"] = $this->battleField;
        }

        if ($this->battleField[$x . $y] == '.') {
            $this->battleField[$x . $y] = '-';
            $_SESSION["battleField"] = $this->battleField;

            
        }
        if ($this->battleField[$x . $y] == 'O') {
            $this->battleField[$x . $y] = 'X';
            $_SESSION["battleField"] = $this->battleField;

        }


        if (in_array('O', $_SESSION["battleField"])) {
            return ['message' => $this->battleField[$x . $y], 'win' => false];
        } else {
            return ['message' => $this->battleField[$x . $y], 'win' => true];
        }
    }

    public function newgame() {

        $this->crateBattleField();
        $_SESSION["battleField"] = $this->battleField;
    }

    public function getXstr($x) {
        $str = 'ABCDEFGHIJ';
        return $str[$x - 1];
    }

    private function crateBattleField() {

        $str = 'ABCDEFGHIJ';
        for ($i = 1; $i <= 10; $i++) {

            for ($char = 0; $char <= 9; $char++) {
                $this->battleField[$str[$char] . $i] = '.';
            }
        }

        foreach ($this->ships as $ship) {
            $this->getRandomShip($ship);
        }
    }

    private function getRandomShip($ship) {

        $direction = rand(0, 1) == 1;
        if ($direction) {
            $y = rand(1, $ship + 1);
            $x = rand(1, 10);

            for ($i = $y; $i < $ship + $y; $i++) {
                if ($this->battleField[$this->getXstr($x) . $i] == 'O') {
                    $this->getRandomShip($ship);
                    return;
                }
            }

            for ($i = $y; $i < $ship + $y; $i++) {
                $this->battleField[$this->getXstr($x) . $i] = 'O';
            }
        } else {
            $y = rand(1, 10);
            $x = rand(1, $ship + 1);

            for ($i = $x; $i < $ship + $x; $i++) {
                if ($this->battleField[$this->getXstr($i) . $y] == 'O') {
                    $this->getRandomShip($ship);
                    return;
                }
            }


            for ($i = $x; $i < $ship + $x; $i++) {
                $this->battleField[$this->getXstr($i) . $y] = 'O';
            }
        }
    }

}
