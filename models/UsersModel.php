<?php

namespace app\models;

use app\core\DbModel;

class UsersModel extends DbModel
{
    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstName = '';
    public string $lastName = '';
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

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName'  => [self::RULE_REQUIRED],
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
        return ['firstName', 'lastName', 'email', 'password', 'status', 'avatar'];
    }

    public function labels(): array
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'passwordConfirmation' => 'Password Confirmation',
            'avatar' => 'Avatar'
        ];
    }
}
