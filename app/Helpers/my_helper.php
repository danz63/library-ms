<?php

use Illuminate\Support\Facades\DB;

function getAuthorOfBook($id)
{
    $writer = DB::table('creations')
        ->join('writers', 'creations.writer_id', '=', 'writers.id')
        ->where('creations.book_id', '=', $id)
        ->first();
    // var_dump($writer);
    return $writer;
}
