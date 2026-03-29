<?php

class BookController extends BaseController
{
    private Book $bookModel;
    private Category $categoryModel;

    public function __construct()
    {
        $this->bookModel = new Book();
        $this->categoryModel = new Category();
    }

    public function index(): void
    {
        $this->render('books/index', [
            'books' => $this->bookModel->all(),
        ]);
    }

    public function create(): void
    {
        $this->render('books/create', [
            'categories' => $this->categoryModel->all(),
        ]);
    }

    public function store(): void
    {
        $data = $this->validateBookForm($_POST);

        if ($data === null) {
            $this->redirect('index.php?controller=book&action=create');
        }

        $this->bookModel->create($data);
        $this->setFlash('success', 'Knjiga je uspješno dodana.');
        $this->redirect('index.php?controller=book&action=index');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $book = $this->bookModel->find($id);

        if (!$book) {
            $this->setFlash('danger', 'Knjiga nije pronađena.');
            $this->redirect('index.php?controller=book&action=index');
        }

        $this->render('books/edit', [
            'book' => $book,
            'categories' => $this->categoryModel->all(),
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $data = $this->validateBookForm($_POST, $id);

        if ($data === null) {
            $this->redirect('index.php?controller=book&action=edit&id=' . $id);
        }

        $this->bookModel->update($id, $data);
        $this->setFlash('success', 'Knjiga je uspješno izmijenjena.');
        $this->redirect('index.php?controller=book&action=index');
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->bookModel->delete($id);
        $this->setFlash('success', 'Knjiga je obrisana.');
        $this->redirect('index.php?controller=book&action=index');
    }

    private function validateBookForm(array $input): ?array
    {
        $title = trim($input['title'] ?? '');
        $author = trim($input['author'] ?? '');
        $publishedYear = (int) ($input['published_year'] ?? 0);
        $categoryId = (int) ($input['category_id'] ?? 0);
        $status = trim($input['status'] ?? 'Dostupna');

        if ($title === '' || $author === '' || $publishedYear === 0 || $categoryId === 0 || $status === '') {
            $this->setFlash('danger', 'Sva polja su obavezna.');
            return null;
        }

        return [
            'title' => $title,
            'author' => $author,
            'published_year' => $publishedYear,
            'category_id' => $categoryId,
            'status' => $status,
        ];
    }
}
