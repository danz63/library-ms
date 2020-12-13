<?php

use Illuminate\Support\Facades\DB;

function getAuthorOfBook($id)
{
    $writer = DB::table('creations')
        ->select('creations.*', 'writers.id as writer_id', 'writers.name')
        ->join('writers', 'creations.writer_id', '=', 'writers.id')
        ->where('creations.book_id', '=', $id)
        ->first();
    return $writer;
}

function getCategoriesOfBooks($id)
{
    $tags = DB::table('tags')
        ->leftjoin('categories', 'tags.category_id', '=', 'categories.id')
        ->where('tags.book_id', '=', $id)
        ->get();
    return $tags;
}

function getPublisherOfBooks($id)
{
    $publisher = DB::table('publications')
        ->select('publications.*', 'publishers.id as publisher_id', 'publishers.name')
        ->leftjoin('publishers', 'publications.publisher_id', '=', 'publishers.id')
        ->where('publications.book_id', '=', $id)
        ->first();
    return $publisher;
}

function getStoragesOfBook($id)
{
    $bookshelf = DB::table('storages')
        ->select('bookshelfs.name')
        ->leftjoin('bookshelfs', 'storages.bookshelfs_id', '=', 'bookshelfs.id')
        ->where('storages.book_id', '=', $id)
        ->first();
    return $bookshelf->name;
}
