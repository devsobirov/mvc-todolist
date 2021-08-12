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

        $receivedPasswordHash = md5(APP_KEY. $password) ;
        $this->db->query('SELECT * FROM users WHERE username = :username AND password = :password');

        //Bind value
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $receivedPasswordHash);

        $user = $this->db->single();

        return $user;
    }
}