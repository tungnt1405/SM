<?php

namespace app\models;

use app\core\UserModel;

class UsersModel extends UserModel
{
    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';
    public string $avatar = '';
    public int $status = self::STATUS_DEACTIVE;

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {
        $this->status = self::STATUS_DEACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function getPrimaryKey(): string
    {
        return 'id';
    }
    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname'  => [self::RULE_REQUIRED],
            'email'     => [
                self::RULE_REQUIRED, self::RULE_EMAIL,
                [
                    self::RULE_UNIQUE, 'class' => self::class
                ]
            ],
            'password'  => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 20]],
            'passwordConfirmation'  => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'avatar'  => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status', 'avatar'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'passwordConfirmation' => 'Password Confirmation',
            'avatar' => 'Avatar'
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
