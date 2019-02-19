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

function testSymmetry ($line) {
    if (strlen($line) % 2 != 0) {
        return false;
    }
    $brackets = [
        '[' => ']',
        '{' => '}',
        '(' => ')',
        '<' => '>'
    ];

    $line1 = new Stack();

    for ($i = 0; $i < strlen($line); $i++) {
        if (array_key_exists($line[$i], $brackets)) {
            $line1->in($brackets[$line[$i]]);
        }
    }

    $line2 = '';
    while (!$line1->isEmpty()){
        $line2 .= $line1->out();
    }

    if ($line2 === substr($line, (strlen($line) / 2))) {
        return true;
    } else {
        return false;
    }
}

var_dump(testSymmetry('(<}>)'));
