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
     * Alias for UserHasTeam::teams
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups() {
        return $this->teams();
    }


    /**
     * Alias for UserHasTeams::attachTeam
     *
     * @param $group
     */
    public function joinGroup($group){
        return $this->attachTeam($group);
    }

    /**
     * Alias for UserHasTeams::detachTeam
     *
     * @param $group
     */
    public function leaveGroup($group){
        return $this->detachTeam($group);
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
