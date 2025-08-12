<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\FirestoreRestClient;
use Illuminate\Support\Arr;

class Financeiro extends Model
{
    protected $table = 'financeiro';

    protected $fillable = [
        'locacao_id', 'valor', 'data_pagamento', 'metodo_pagamento'
    ];

    protected static function useFirestore(): bool
    {
        return (bool) config('firebase.enabled');
    }

    protected static function firestoreClient(): FirestoreRestClient
    {
        return new FirestoreRestClient(
            config('firebase.project_id'),
            config('firebase.credentials')
        );
    }

    public static function all($columns = ['*'])
    {
        if (!static::useFirestore()) return parent::all($columns);

        $rows = static::firestoreClient()->listDocuments('financeiro');
        return collect(array_map(function ($r) {
            $m = new static();
            $m->exists = true;
            $m->attributes = Arr::except($r, ['id']);
            $m->setAttribute('id', $r['id'] ?? null);
            return $m;
        }, $rows));
    }

    public static function find($id, $columns = ['*'])
    {
        if (!static::useFirestore()) return parent::find($id, $columns);

        $doc = static::firestoreClient()->getDocument('financeiro', (string)$id);
        if (!$doc) return null;
        $m = new static();
        $m->exists = true;
        $m->attributes = Arr::except($doc, ['id']);
        $m->setAttribute('id', $doc['id'] ?? null);
        return $m;
    }

    public static function findOrFail($id, $columns = ['*'])
    {
        $res = static::find($id, $columns);
        if ($res === null) {
            throw (new \Illuminate\Database\Eloquent\ModelNotFoundException())->setModel(static::class, $id);
        }
        return $res;
    }

    public static function create(array $attributes = [])
    {
        if (!static::useFirestore()) return parent::create($attributes);

        $id = uniqid();
        static::firestoreClient()->setDocument('financeiro', $id, $attributes);
        $m = new static();
        $m->exists = true;
        $m->attributes = $attributes;
        $m->setAttribute('id', $id);
        return $m;
    }

    public function save(array $options = [])
    {
        if (!static::useFirestore()) return parent::save($options);

        $id = $this->getAttribute('id') ?? uniqid();
        $data = $this->getAttributes();
        unset($data['id']);
        static::firestoreClient()->setDocument('financeiro', $id, $data);
        $this->setAttribute('id', $id);
        $this->exists = true;
        return true;
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (!static::useFirestore()) return parent::update($attributes, $options);
        $this->fill($attributes);
        return $this->save($options);
    }

    public function delete()
    {
        if (!static::useFirestore()) return parent::delete();

        $id = $this->getAttribute('id');
        if (!$id) return false;
        static::firestoreClient()->deleteDocument('financeiro', (string)$id);
        $this->exists = false;
        return true;
    }

    public function getRouteKey()
    {
        return $this->getAttribute('id') ?? parent::getRouteKey();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (!static::useFirestore()) return parent::resolveRouteBinding($value, $field);
        return static::findOrFail($value);
    }
}
