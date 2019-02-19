<?php

class Stack {

    private $storage = [];
    private $top = 0;

    public function in($value) {
        $this->storage[$this->top++] = $value;
    }

    public function isEmpty() {
        return $this->top === 0;
    }

    public function last() {
        return $this->storage[$this->top-1];
    }

    public function out() {
        return $this->storage[--$this->top];
    }
}

class queueFromStacks
{
    private $inStack;
    private $outStack;

    public function __construct() {
        $this->inStack = new Stack();
        $this->outStack = new Stack();
    }

    public function in($value) {
        $this->inStack->in($value);
    }

    public function isEmpty() {
        return ($this->inStack->isEmpty() && $this->outStack->isEmpty()) === true;
    }

    public function out() {
        if (!$this->outStack->isEmpty()) {
            return $this->outStack->out();
        } else {
            while (!$this->inStack->isEmpty()) {
                $this->outStack->in($this->inStack->out());
            }
            return $this->outStack->out();
        }
    }
}

$object = new queueFromStacks();

for ($i = 0; $i < 10; $i++) {
    $object->in($i.'$');
}

var_dump($object->isEmpty());

for ($i = 0; $i < 10; $i++) {
    echo $object->out(), PHP_EOL;
}


var_dump($object->isEmpty());