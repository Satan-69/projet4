<?php

class Form
{
    public function input($name)
    {
        return '<input autofocus type="text" name="' . $name . '">';
    }

    public function password()
    {
        return '<input type="password" name="password">';
    }

    public function textArea($name)
    {
        return '<textarea name ="' . $name . '" rows=10 cols=40 placeholder="Écrivez votre message ici."></textarea>';
    }

    public function submit()
    {
        return '<button class="btn btn-info mt-3" type ="submit">Envoyer</button>';
    }
}
