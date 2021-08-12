<?php


class Task extends Model
{
    protected $table = 'tasks';
    public $perPage = 3;

    /**
     * Получает пагинированный список для главной страницы
     * @param $column
     * @param $inOrder
     * @param int $currentPage
     * @return mixed
     */
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

    /**
     * Создает новых заданий в БД
     * @param $data
     * @return bool
     */
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

    /**
     * Обновляет контест задания и изменяет статус задания на "Редактировано"
     * @param $id
     * @param $content
     * @return mixed
     */
    public function update($id,  $content)
    {
        $this->db->query("UPDATE {$this->table} SET content = :content WHERE id = :id");
        $this->db->bind(':content', $content);
        $this->db->bind(':id', $id);

        $result = $this->db->execute();
        if ($result) {
            $result = $this->setUpdatedAt($id);
        }

        return $result;
    }

    /**
     * Возвращает количество записей в БД
     * @return mixed|int
     */
    public function getTotalRows ()
    {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $this->db->execute();
        $result = $this->db->single();

        return $result->total;
    }

    /**
     * Изменяет статус на задания "Редактировано"
     * @param $id
     * @return mixed
     */
    public function setStatus($id)
    {
        $result = null;
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");

        $this->db->bind(':status', 1);
        $this->db->bind(':id', $id);

        $result = $this->db->execute();
        if ($result) {
            $result = $this->setUpdatedAt($id);
        }
        return $result;
    }

    /**
     * Выполняет логику для изменения статуса задания
     * @param $id
     * @return mixed
     */
    public function setUpdatedAt($id)
    {
        $this->db->query("UPDATE {$this->table} SET updated_at = :updated WHERE id = :id");

        $this->db->bind(':updated', date('Y-m-d h:i:s'));
        $this->db->bind(':id', $id);

        $result = $this->db->execute();
        return $result;
    }
}