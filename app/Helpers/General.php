<?php

function showName(){
    return "ali alasmar";
}
function get_languages(){
    $lang= \App\Models\Language::active()->get();
    return $lang;
}

function get_defualt_language(){

    return app()->getLocale();
}
