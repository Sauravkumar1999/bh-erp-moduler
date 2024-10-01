<?php

namespace Modules\User\Traits;

trait UserSequenceManager
{
    /**
     * Generate next user code
     *
     * @return string
     */
    public function getNextUserCode()
    {
        $prefix = setting('users.code_prefix', 'U-');
        $next = setting('users.code_next', '1');
        $digit = setting('users.code_digit', '5');

        $code = $prefix . str_pad($next, $digit, '0', STR_PAD_LEFT);

        return $code;
    }

    /**
     * Increase the next user code
     */
    public function increaseNextUserCode()
    {
        $next = setting('users.code_next', 1) + 1;

        setting(['users.code_next' => $next])->save();
    }

    /**
     * Get user logged in
     *
     * @return object
     */
    public function getCurrentUser()
    {
        return user();
    }
}
