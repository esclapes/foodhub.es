<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Teamwork\Traits\UserHasTeams;

class User extends Authenticatable
{

    use UserHasTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *
     * Alias for teams
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups() {
        return $this->teams();
    }

    public function joinGroup($group){
        $this->attachTeam($group);
    }

    public function leaveGroup($group){
        $this->detachTeam($group);
    }

    /**
     *
     * TODO: change when implementing group roles
     *
     * uses trait to check if user is current team admin
     *
     * @return bool
     */
    public function isCurrentTeamAdmin() {
        return $this->isOwnerOfTeam($this->currentTeam());
    }

}
