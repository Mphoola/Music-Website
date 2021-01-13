<?php

namespace App;

use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use HasRoles;
    use LogsActivity;
    use Notifiable;
    use CausesActivity;

    protected static $logName = 'admin';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'email'];

    protected $fillable = [
        'name', 'email', 'password', 'last_login_at',
        'last_login_ip', 'password_changed_at', 'image', 'bio'
    ];

    protected $hidden = [
        'password'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function beats(){
        return $this->hasMany(Beat::class, 'admin_id');
    }
    public function songs(){
        return $this->hasMany(Song::class, 'admin_id');
    }
    public function videos(){
        return $this->hasMany(Video::class, 'admin_id');
    }
    public function videoApprovals(){
        return $this->hasMany(Video::class, 'verified_by');
    }

    public function song_upload_alert(){
        
    }
    public function sceopeBeatUploadAlert($query){
        return $query->unreadNotifications
            ->where('type', 'App\Notifications\newBeatUploaded')
            ->count();
    }
    public function video_upload_alert(){

    }


}
