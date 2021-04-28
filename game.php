<?php
session_start();
abstract class Game {
    // Properties
    protected $mode; //bot and user
    protected $difficulty; //easy, medium, hard
    protected $tries; //counts how many times you tried
    protected $answer; //correct answer
    protected $min;
    protected $max;



    //contructor
    function __construct($mode, $difficulty) {
        $this->mode = $mode;
        $this->difficulty = $difficulty;
        $this->min = 1;
        
        if($difficulty == "Easy") {
            $this->max = 10;
        }
        else if ($difficulty == "Medium") {
            $this->max = 50;
        }
        else if ($difficulty == "Hard") {
            $this->max = 100;
        }
    }

    function incrementTries() {
        $this->tries++;
    }
    
    //setter
    function setAnswer ($answer) {
        $this->answer = $answer;
    }
    function setMin($min) {
        $this->min = $min;
    }
    function setMax($max) {
        $this->max = $max;
    }
    
    // Getters
    function getMode() {
        return $this->mode;
    }
    function getDifficulty() {
        return $this->difficulty;
    }
    function getTries() {
        return $this->tries;
    }
    function getAnswer() {
        return $this->answer;
    }
    function getMin() {
        return $this->min;
    }
    function getMax() {
        return $this->max;
    }
    
    
    
}

class User extends Game {
    
    public function __construct($mode, $difficulty){
        parent::__construct($mode, $difficulty);
        $this->randomizer();
    }
    
    public function randomizer() {
        $this->answer = rand($this->min, $this->max);
    }
    
    public function gameUser ($myGuess) {
        $this->incrementTries();
        if($myGuess == $this->answer) {
            echo "<p> Congrats </p>";
            return true;
        }
        else if ($myGuess < $this->answer) {
            echo "<p> Higher </p>";
            return false;
        }
        else if ($myGuess > $this->answer) {
            echo "<p> Lower </p>";
            return false;
        }
    }
}

class Bot extends Game {
    
    private $guessNumber;
    private $random;
    public function __construct($mode, $difficulty){
        parent::__construct($mode, $difficulty);
        $this->tries = 1;
        $this->random = $this->max/2;
    }
    
    public function randomizer() {
        $this->random = rand($this->min, $this->max);
    }
    
    public function getRandom() {
        return $this->random;
    }
    
    public function checkValues() {
        if ($this->min == $this->max || $this->min > $this->max) {
            return true;
        } else {
            return false;
        }
        
    }
}