<?php

class Form
{
    public function input($name, $id)
    {
        return '<input autofocus type="text" name="' . $name . '" id="' . $id . '">';
    }

    public function password($id)
    {
        return '<input type="password" id="'.$id.'" name="password">';
    }

    public function textArea($name)
    {
        return '<textarea name ="' . $name . '" rows=10 cols=40 placeholder="Écrivez votre message ici."></textarea>';
    }
}
