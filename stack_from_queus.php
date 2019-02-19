<?php

class Queue {
    private $storage = [];
    private $head = 0;
    private $tail = 0;
    private $count =0;

    public function in($value) {
        $this->storage[$this->tail++] = $value;
        $this->count++;
    }

    public function isEmpty() {
        return $this->head === $this->tail;
    }

    public function out() {
        $res = $this->storage[$this->head++];
        if($this->head > $this->tail) {
            $this->head = $this->tail = 0;
        }
        $this->count--;
        return $res;
    }

    public function size () {
        return $this->count;
    }
}

class stackFromQueues {
    private $queue1;
    private $queue2;

    public function __construct() {
    $this->queue1 = new Queue();
    $this->queue2 = new Queue();
    }

    public function isEmpty() {
    return ($this->queue1->isEmpty() && $this->queue2->isEmpty()) === true;
    }

    public function in($value) {
    if ($this->queue1->isEmpty()) {
        $this->queue2->in($value);
    } else {
        $this->queue1->in($value);
      }
    }

    public function out() {
    if ($this->queue2->isEmpty()) {
        $size = $this->queue1->size();
        $count = 0;
        while ($count < $size - 1) {
            $this->queue2->in($this->queue1->out());
            $count++;
        }
        return $this->queue1->out();
    } else {
        $size = $this->queue2->size();
        $count = 0;
        while ($count < $size - 1) {
            $this->queue1->in($this->queue2->out());
            $count++;
        }
        return $this->queue2->out();
      }
    }
}

$obj = new stackFromQueues();
for ($i = 0; $i < 10; $i++) {
    $obj->in($i.'$');
}

var_dump($obj->isEmpty());

for ($i = 0; $i < 10; $i++) {
    echo $obj->out(), PHP_EOL;
}
var_dump($obj->isEmpty());
