<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname', 'email', 'password','isAdmin','score'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private function getScores() {
        return User::select(DB::raw('users.id AS ID,
                                    CASE WHEN sum(routes.score_route) IS NULL then 0
                                        ELSE sum(routes.score_route)
                                        END as SCORE'))
                    ->leftJoin('finished_routes','users.id','finished_routes.id_user')
                    ->leftJoin('routes','finished_routes.id_route','routes.id_route')
                    ->groupBy('users.id');
    }

    public function getUserScore($id) {
        return User::getScores()->where('id',$id)->first();
    }

    public function getUsersScore($ids) {
        return User::getScores()->whereIn('id',$ids)->pluck('SCORE','ID');
    }
}
