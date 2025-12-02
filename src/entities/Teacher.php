<?php

class Teacher extends User
{
    public $id;
    public $name;
    public $surname;

    public $roles = ['ROLE_TEACHER'];

    public function __construct($id, $name, $surname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    }
}