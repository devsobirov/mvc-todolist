<?php


class User extends Model
{
    protected $table = 'users';

    /**
     * @param $username
     * @param $password
     * @return bool|User|Model
     */
    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        $recievedPasswordHash = md5(APP_KEY. $password) ;
        if ($recievedPasswordHash === $hashedPassword) {
            return $row;
        }

        return false;
    }
}