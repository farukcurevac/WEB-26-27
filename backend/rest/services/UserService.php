<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService
{
    protected $entity_name = 'User';

    public function __construct($dao = null)
    {
        parent::__construct($dao ?? new UserDao());
    }

    public function add($user)
    {
        $this->validate($user);
        Validator::required($user, ['password']);
        Validator::password($user['password'], 'password');

        // Lozinka se uvijek hashira prije spremanja u bazu
        $user['password_hash'] = password_hash($user['password'], PASSWORD_BCRYPT);
        unset($user['password']);
        $user['email'] = strtolower(trim($user['email']));

        $created = $this->dao->add($user);
        return $this->sanitize($this->dao->get_by_id($created['id']));
    }

    public function update($user, $id)
    {
        $this->get_by_id($id);
        $this->validate($user, $id);

        if (!empty($user['password'])) {
            Validator::password($user['password'], 'password');
            $user['password_hash'] = password_hash($user['password'], PASSWORD_BCRYPT);
            unset($user['password']);
        }
        if (isset($user['email'])) {
            $user['email'] = strtolower(trim($user['email']));
        }

        $this->dao->update($user, $id);
        return $this->sanitize($this->dao->get_by_id($id));
    }

    public function get_all()
    {
        $users = parent::get_all();
        return array_map([$this, 'sanitize'], $users);
    }

    public function get_by_id($id)
    {
        return $this->sanitize(parent::get_by_id($id));
    }

    protected function validate($user, $id = null)
    {
        Validator::required($user, ['first_name', 'last_name', 'email']);
        Validator::length($user['first_name'], 'first_name', 2, 50);
        Validator::length($user['last_name'], 'last_name', 2, 50);
        Validator::email($user['email'], 'email');

        $existing = $this->dao->get_user_by_email(strtolower(trim($user['email'])));
        if ($existing && $existing['id'] != $id) {
            throw new ValidationException("Email '{$user['email']}' is already registered.");
        }
    }

    private function sanitize($user)
    {
        if (is_array($user)) {
            unset($user['password_hash']);
        }
        return $user;
    }
}