<?php

trait PostOperationsTrait
{
    public function create($db)
    {
        $query = "INSERT INTO Posts (title, content, author, created_at, updated_at) 
                  VALUES ('{$this->title}', '{$this->content}', '{$this->author}', NOW(), NOW())";
        $result = $db->executeQuery($query);

        if ($result) {
            $this->id = $db->conn->insert_id;
            return true;
        } else {
            return false;
        }
    }

    public function update($db)
    {
        if ($this->id !== null) {
            $query = "UPDATE Posts SET title='{$this->title}', content='{$this->content}', author='{$this->author}', updated_at=NOW() WHERE id={$this->id}";
            $result = $db->executeQuery($query);

            return $result;
        } else {
            return false;
        }
    }

    public function delete($db)
    {
        if ($this->id !== null) {
            $query = "DELETE FROM Posts WHERE id={$this->id}";
            return $db->executeQuery($query);
        } else {
            return false;
        }
    }

    public static function fetchById($db, $id)
    {
        $query = "SELECT * FROM Posts WHERE id={$id}";
        $result = $db->executeQuery($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $post = new Post($row['title'], $row['content'], $row['author'], $row['created_at'], $row['updated_at']);
            $post->setId($row['id']);
            return $post;
        } else {
            return null;
        }
    }

    public static function fetchAll($db)
    {
        $query = "SELECT * FROM Posts ORDER BY created_at DESC";
        $result = $db->executeQuery($query);

        if ($result && $result->num_rows > 0) {
            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $post = new Post($row['title'], $row['content'], $row['author'], $row['created_at'], $row['updated_at']);
                $post->id = $row['id'];
                $posts[] = $post;
            }
            return $posts;
        } else {
            return [];
        }
    }
}
