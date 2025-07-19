<?php

namespace App\Domains\Auth\Events\User;

use App\Domains\Auth\Models\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobStatusChanged.
 */
class UserStatusChanged
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $status;

    /**
     * JobStatusChanged constructor.
     *
     * @param  User  $user
     * @param $status
     */
    public function __construct(User $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }
}
