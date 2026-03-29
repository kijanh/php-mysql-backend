<?php

class Book
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        $sql = 'SELECT books.*, categories.name AS category_name
                FROM books
                INNER JOIN categories ON books.category_id = categories.id
                ORDER BY books.id DESC';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $book = $stmt->fetch();
        return $book ?: null;
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO books (title, author, published_year, category_id, status)
                VALUES (:title, :author, :published_year, :category_id, :status)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => $data['published_year'],
            'category_id' => $data['category_id'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE books
                SET title = :title,
                    author = :author,
                    published_year = :published_year,
                    category_id = :category_id,
                    status = :status
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'author' => $data['author'],
            'published_year' => $data['published_year'],
            'category_id' => $data['category_id'],
            'status' => $data['status'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM books WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
