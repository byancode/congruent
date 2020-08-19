<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Activityable;

class File extends Model
{
    use Modelable, Typeable, Statusable, Commentable, Activityable;

    protected $table = 'files';
    const type = 'file';

    protected $fillable = [
        'uuid',
        'path', 
        'link', 
        'disk',
        'name',
        'mime',
        'size',
        'type_id', 
        'details',
        'loggers',
        'options',
        'visibility',
        'extension',
    ];
    protected $guarded = [
        'realPath',
        'dirPath',
        'loggers'
    ];

    protected $casts = [
        'loggers' => 'object',
        'details' => 'object',
        'options' => 'object',
    ];
    // -------------------------
    protected $appends = [];

    public function getUrlAttribute()
    {
        return $this->storage->url($this->path);
    }
    public function getDirPathAttribute()
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $this->path);
    }
    public function getRealPathAttribute()
    {
        return $this->storage->path($this->path);
    }
    public function getStorageAttribute()
    {
        return Storage::disk($this->disk);
    }
    public function exists()
    {
        return $this->storage->exists($this->path);
    }
    public function getNameAttribute()
    {
        return Str::slug($this->name);
    }
    public function getExistsAttribute()
    {
        return $this->exists();
    }
    public function getContentAttribute()
    {
        return $this->storage->get($this->path);
    }
    public function download(array $headers = [])
    {
        $this->storage->download($this->path, "{$this->name}.{$this->extension}", $headers);
    }
    public function getLocalFileAttribute()
    {
        return new \Illuminate\Http\File($this->realPath);
    }
    public static function bootable()
    {
        static::deleted(function(File $file) {
            $file->storage->delete($file->path);
        });
    }
}