<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Single;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Fidum\EloquentMorphToOne\HasMorphToOne;

trait Singleable
{
    use HasMorphToOne;

    public function single(string $relation, Array $payload = [])
    {
        \ksort($payload);
        return $this->morphToOne($relation, 'model', 'singles', 'model_id', 'relation_id')->wherePivot('relation_type', $relation)->wherePivot('payload', \json_encode($payload));
    }
    public function createSingle(Model $relation, Array $payload = [])
    {
        \ksort($payload);
        return $this->morphOne(Single::class, 'model', 'singles')->create([
            'payload' => $payload,
            'relation_id' => $relation->id,
            'relation_type' => \get_class($relation)
        ]);
    }
}