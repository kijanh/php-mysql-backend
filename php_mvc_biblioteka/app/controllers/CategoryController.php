<?php

class CategoryController extends BaseController
{
    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index(): void
    {
        $this->render('categories/index', [
            'categories' => $this->categoryModel->all(),
        ]);
    }

    public function create(): void
    {
        $this->render('categories/create');
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            $this->setFlash('danger', 'Naziv kategorije je obavezan.');
            $this->redirect('index.php?controller=category&action=create');
        }

        $this->categoryModel->create([
            'name' => $name,
            'description' => $description,
        ]);

        $this->setFlash('success', 'Kategorija je uspješno dodana.');
        $this->redirect('index.php?controller=category&action=index');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $category = $this->categoryModel->find($id);

        if (!$category) {
            $this->setFlash('danger', 'Kategorija nije pronađena.');
            $this->redirect('index.php?controller=category&action=index');
        }

        $this->render('categories/edit', ['category' => $category]);
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            $this->setFlash('danger', 'Naziv kategorije je obavezan.');
            $this->redirect('index.php?controller=category&action=edit&id=' . $id);
        }

        $this->categoryModel->update($id, [
            'name' => $name,
            'description' => $description,
        ]);

        $this->setFlash('success', 'Kategorija je uspješno izmijenjena.');
        $this->redirect('index.php?controller=category&action=index');
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->categoryModel->delete($id);
        $this->setFlash('success', 'Kategorija je obrisana.');
        $this->redirect('index.php?controller=category&action=index');
    }
}
