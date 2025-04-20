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
        $result = self::sColumns($pdo,  $table, $data, "insert");
        $query = "INSERT INTO $table ({$result['columns_name']}) VALUES ({$result['placeholders']})";
        $stmt = $pdo->prepare($query);
        return $stmt->execute($result['data']);
    }

    public static function update(PDO $pdo, string $table, array $data, string $idColumn, $idValue): bool
    {
        $columns = self::sColumns($pdo,  $table, $data, "update");
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($columns)));
        // var_dump($set);
        // exit();
        $query = "UPDATE $table SET $set WHERE $idColumn = :id";
        $columns['id'] = $idValue;
        $stmt = $pdo->prepare($query);
        return $stmt->execute($columns);
    }

    public static function delete(PDO $pdo, string $table, string $idColumn, $idValue): bool
    {
        $query = "DELETE FROM $table WHERE $idColumn = :id";
        $stmt = $pdo->prepare($query);
        return $stmt->execute(['id' => $idValue]);
    }
    public static function sColumns(PDO $pdo, string $table, array $data, string $status): string | array
    {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM $table");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        array_shift($columns);
        if (count($columns)  !=  count($data)) {
            throw new Exception("The number of columns and data do not match");
        }
        if ($status === "insert") {
            return self::returnValue($columns , $data);
        } elseif ($status === "update") {
            $columns = array_combine($columns, array_values($data));
        }
        return $columns;
    }
    public static function returnValue(array $columns, array $data): array
    {
        $columns_name = implode(",", array_values($columns));
        $placeholders = ':' . implode(', :', array_values($columns));
        $columns = array_combine($columns, array_values($data));
        return ["data" => $columns, "placeholders" => $placeholders, "columns_name" => $columns_name];
    }
}