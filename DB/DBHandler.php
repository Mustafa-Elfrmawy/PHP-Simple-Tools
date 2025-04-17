<?php

class DBHandler
{
    public static function select(PDO $pdo, string $query, array $params = []): array
    {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert(PDO $pdo, string $table, array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute($data);
    }

    public static function update(PDO $pdo, string $table, array $data, string $idColumn, $idValue): bool
    {
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = "UPDATE $table SET $set WHERE $idColumn = :id";
        $data['id'] = $idValue;
        $stmt = $pdo->prepare($query);
        return $stmt->execute($data);
    }

    public static function delete(PDO $pdo, string $table, string $idColumn, $idValue): bool
    {
        $query = "DELETE FROM $table WHERE $idColumn = :id";
        $stmt = $pdo->prepare($query);
        return $stmt->execute(['id' => $idValue]);
    }
}
