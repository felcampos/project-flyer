<?php

function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash; // se chamar flash()-> ira retornar um objeto Flash (App\Http\Flash)
    }

    return $flash->info($title, $message); // se chamar direto flash('titulo', 'corpo') irá chamar o medoto info por padrao.
}
