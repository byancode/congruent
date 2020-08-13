<?php

namespace Byancode\Congruent\Observers;

use Illuminate\Database\Eloquent\Model;

class TypeableObserver
{
    public function defineType(Model $model)
    {
        $model->type_id = $model::type;
    }
    public function retrieved(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function creating(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function created(Model $model)
    {
        # code...
    }
    public function updating(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function updated(Model $model)
    {
        # code...
    }
    public function saving(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function saved(Model $model)
    {
        # code...
    }
    public function restoring(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function restored(Model $model)
    {
        # code...
    }
    public function replicating(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function deleting(Model $model)
    {
        $this->defineType($model);
        # code...
    }
    public function deleted(Model $model)
    {
        # code...
    }
    public function forceDeleted(Model $model)
    {
        # code...
    }
}