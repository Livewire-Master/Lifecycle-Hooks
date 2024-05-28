<?php

namespace App\Traits;

use Exception;

trait WithUserInfo
{
    /**
     * Updating Hook
     *
     * @param string $property
     * @param mixed  $value
     *
     * @throws Exception
     */
    public function updatingWithUserInfo(string $property, mixed $value): void
    {
        if ($property === 'user_id')
        {
            throw new Exception('You can not change User ID');
        }

        if ($property === 'username' && strlen($value) <= 3)
        {
            $this->addError('username', 'Username must be at least 3 characters long');
        }
        else
        {
            $this->resetErrorBag('username');
        }
    }

    /**
     * Updated Hook
     *
     * @param string $property
     *
     * @return void
     */
    public function updatedWithUserInfo(string $property): void
    {
        if ($property === 'username')
        {
            $this->username = trim(strtoupper($this->username));
        }
    }

    /**
     * Updating Email Property
     *
     * @param mixed $value
     *
     * @return void
     */
    public function updatingEmailWithUserInfo(mixed $value): void
    {
        if (strlen($value) <= 3)
        {
            $this->addError('email', 'Email must be at least 3 characters long');
        }
        else
        {
            $this->resetErrorBag('email');
        }
    }

    /**
     * Updated Email Property
     *
     * @return void
     */
    public function updatedEmailWithUserInfo(): void
    {
        $this->email = trim(strtolower($this->email));
    }
}
