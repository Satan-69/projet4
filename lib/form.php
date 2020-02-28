<?php

class Form
{
    public function input($name)
    {
        return '<input type="text" name="' . $name . '">';
    }

    public function textArea()
    {
        return '<textarea rows=10 cols=40 placeholder="Écrivez votre message ici."></textarea>';
    }

    public function submit()
    {
        return '<button class="btn btn-info mt-3" type ="submit">Envoyer</button>';
    }
}
