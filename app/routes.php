<?php

// Home page
$app->get('/', function () use ($app) {
    $books = $app['dao.book']->findAll();
    return $app['twig']->render('index.html.twig', array('books' => $books));
})->bind('home');

$app->get('/book/{id}', function ($id) use ($app) {
    return $app['twig']->render('book.html.twig', array('book' => $book));
})->bind('book');