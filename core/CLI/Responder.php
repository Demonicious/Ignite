<?php namespace Ignite\CLI;

class Responder {
    public function echo($message) {
        echo $message;

        return $this;
    }

    public function nl() {
        $this->echo("\n");

        return $this;
    }

    public function message($message) {
        $this->nl();
        $this->echo($message);
        $this->nl();
        $this->nl();

        return $this;
    }

    public function default($msg = '') {
        return "\e[39m$msg";
    }

    public function blue($msg = '') {
        return "\e[34m$msg" . $this->default();
    }
    
    public function green($msg = '') {
        return "\e[92m$msg" . $this->default();
    }

    public function yellow($msg = '') {
        return "\e[93m$msg" . $this->default();
    }

    public function red($msg = '') {
        return "\e[91m$msg" . $this->default();
    }
}