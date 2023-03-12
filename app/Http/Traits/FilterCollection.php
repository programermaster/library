<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

trait FilterCollection
{

    protected $operator = 'LIKE';

    /**
     * Collect uri parameters from query string for pagination and searching.
     *
     * @param  FormRequest  $request
     * @return Collection
     */
    public function getFilters(FormRequest $request): Collection
    {
        return collect([
            'page' => 1,
            'rowsPerPage' => config('app.default_per_page'),
            'filter' => ''
        ])->merge($request->validated());
    }

    /**
     * Paginated result set.
     *
     * @param  Builder  $builder
     * @param  Collection  $query
     *
     * @return LengthAwarePaginator
     */
    private function getResultPerPage(Builder $builder, Collection $query): LengthAwarePaginator
    {
        $page = (int) $query->get('page');
        $perPage = (int) $query->get('rowsPerPage');
        $builder->offset($page * $perPage);

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param  Builder  $builder
     * @param  array  $columns  Columns to search into
     * @param  string|null  $filters  Search keywords
     */
    private function filterByQuery(Builder $builder, array $columns, string $filters): void
    {
        if (empty(trim((string) $filters))) {
            return;
        }

        $filters = array_map(static fn($f) => '%'.trim($f).'%', explode(' ', $filters));

        // Every search keyword wrapped in "AND (col1 OR col2 OR ...)" block
        foreach ($filters as $filter) {
            $this->andFilter($builder, $columns, $filter);
        }
    }

    private function andFilter(Builder $builder, array $columns, string $filter): void
    {
        $operator = $this->operator;

        $builder->where(static function (Builder $query) use ($columns, $filter, $operator) {
            foreach ($columns as $column) {
                $query->orWhere($column, $operator, $filter);
            }
        });
    }
}
