<?php

class DatabaseController
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $table, array $data): void
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function search(string $table): array
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(string $table, array $data, array $conditions): void
    {
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $where = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $sql = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge($data, $conditions));
    }

    public function delete(string $table, array $conditions): void
    {
        $where = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);
    }
}