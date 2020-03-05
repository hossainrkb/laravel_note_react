<?php

namespace App;

use App\Note;
use App\Role_table;
use App\User_role_table;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role(){
        return $this->belongsToMany(Role_table::class,User_role_table::class,"u_id","r_id");
    }

    public function isAdminOrEditor(){
        $check = $this->user_role;
        foreach ($check as $value) {
            //dump($value["role_name"]);
            if($value["role_name"] == "admin"){
                dd("true");
                //return true;
            }
            else{
                return false;
                continue;
            }
        }
    }

    public function hasNotes(){
        return $this->hasMany(Note::class,'user_id','id');
    }


}
