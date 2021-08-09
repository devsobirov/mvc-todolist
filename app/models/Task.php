<?php


class Task extends Model
{
    protected $table = 'tasks';
    public $perPage = 3;

    public function getPaginatedTasks($column, $inOrder, $currentPage = 1 )
    {
        $offset = ($currentPage - 1) * $this->perPage;
        $sql = "
            SELECT * FROM {$this->table}
            ORDER BY $column $inOrder
            LIMIT {$this->perPage}
            OFFSET $offset        
        ";
        $this->db->query($sql);

        $tasks = $this->db->resultSet();

        return $tasks;
    }

    public function createTask($data)
    {
        $this->db->query("INSERT INTO {$this->table} (username, user_email, content) VALUES (:username, :user_email, :content)");

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':user_email', $data['user_email']);
        $this->db->bind(':content', $data['content']);

        if ($this->db->execute()) {
            return true;
        }
        return  false;
    }

    public function getTotalRows ()
    {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $this->db->execute();
        $result = $this->db->single();

        return $result->total;
    }
}