<?php

namespace hetparekh21\searchable;

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
        $columns = [];

        foreach ($this->getFillable() as $column) {
            if (in_array($column, $this->getExceptions())) {
                continue;
            }
            $columns[] = $column;
        }

        if (isset($this->useGuarded) && $this->useGuarded == true) {
            foreach ($this->getGuarded() as $column) {
                if (in_array($column, $this->getExceptions())) {
                    continue;
                }
                $columns[] = $column;
            }
        }

        return $columns;
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
