<?php
namespace Byancode\Congruent\Traits;

use Illuminate\Support\Arr;
use Byancode\Congruent\App\Relation;
use Illuminate\Database\Eloquent\Model;
use Fidum\EloquentMorphToOne\HasMorphToOne;

trait Relationable
{
    use HasMorphToOne;

    public function checkRelation(Model $relation, string $type, string $status)
    {
        // return $this->hasRelation(\get_class($relation, $type)); // PENDIENTE
    }

    public function hasRelation(string $relation, $type = [])
    {
        return $this->morphToOne(
            $relation, 
            'modelable', 
            'relationables', 
            'modelable_id', 
            'relationable_id'
        )->using(Relation::class)->wherePivot('relationable_type', $relation)->wherePivotIn('type_id', Arr::wrap($type));
    }

    public function hasReationMany(string $relation, $type = [])
    {
        return $this->morphToMany(
            $relation, 
            'modelable', 
            'relationables', 
            'modelable_id', 
            'relationable_id'
        )->using(Relation::class)->wherePivot('relationable_type', $relation)->wherePivotIn('type_id', Arr::wrap($type));
    }

    public function isRelated(string $relation, $type = [])
    {
        return $this->morphedByOne(
            $relation, 
            'modelable', 
            'relationables', 
            'modelable_id', 
            'relationable_id'
        )->using(Relation::class)->wherePivot('relationable_type', $relation)->wherePivotIn('type_id', Arr::wrap($type));
    }

    public function isRelatedMany(string $relation, $type = [])
    {
        return $this->morphedByMany(
            $relation, 
            'modelable', 
            'relationables', 
            'modelable_id', 
            'relationable_id'
        )->using(Relation::class)->wherePivot('relationable_type', $relation)->wherePivotIn('type_id', Arr::wrap($type));
    }
    public function createRelation(string $type, Model $relation, array $details = [])
    {
        return $this->getOneRelacion()->create([
            'type_id' => $type,
            'details' => $details,
            'relationable_id' => $relation->id,
            'relationable_type' => \get_class($relation),
        ]);
    }
    public function updateOrCreateRelation(string $type, Model $relation, array $details = [])
    {
        return $this->getOneRelacion()->updateOrCreate([
            'type_id' => $type,
            'relationable_id' => $relation->id,
            'relationable_type' => \get_class($relation)
        ], [
            'details' => $details,
        ]);
    }
    public function removeRelation(string $type, Model $relation)
    {
        return $this->getOneRelacion()->where([
            'type_id' => $type,
            'relationable_id' => $relation->id,
            'relationable_type' => \get_class($relation)
        ])->remove();
    }
    public function getOneRelacion()
    {
        return $this->morphOne(Relation::class, 'modelable', 'relationables');
    }
    public function getManyRelation()
    {
        return $this->morphMany(Relation::class, 'modelable', 'relationables');
    }
}