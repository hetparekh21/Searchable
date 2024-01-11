<?php

namespace Hetparekh21\Searchable;

/**
 * Trait Searchable
 * @property array $except
 * @property bool $useGuarded
 */
trait Searchable
{

    public function scopeSearch($query, $keyword)
    {
        $columns = $this->getModelColumns();

        return $query->where(function ($query) use ($keyword, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . $keyword . '%');
            }
        });
    }

    protected function getModelColumns(): array
    {
        $columns = collect($this->getFillable());

        if (property_exists($this, 'useGuarded') && $this->useGuarded) {
            $columns = $columns->merge($this->getGuarded())->unique();
        }

        $columns = $columns->except($this->getExceptions());

        return $columns->toArray();
    }

    protected function getExceptions(): array
    {

        if (isset($this->except)) {
            return $this->except;
        } else {
            return [];
        }
    }
}
