<?php

class HomeController extends BaseController
{
    public function index(): void
    {
        $bookModel = new Book();
        $categoryModel = new Category();

        $this->render('home/index', [
            'booksCount' => count($bookModel->all()),
            'categoriesCount' => count($categoryModel->all()),
        ]);
    }
}
