<?php

namespace App\apis\blog\services;

use App\apis\blog\models\Blog;
use Illuminate\Database\Eloquent\Collection;

class BlogCRUDService
{
    public function getAll(array $filters = []): Collection
    {
        $query = Blog::query();

        foreach ($filters as $filter) {
            $query->where($filter['field'], $filter['operator'], $filter['value']);
        }

        return $query->get();
    }

    public function getById(int $id): ?Blog
    {
        return Blog::find($id);
    }

    public function create(array $data): Blog
    {
        return Blog::create($data);
    }

    public function update(int $id, array $data): ?Blog
    {
        $blog = Blog::find($id);
        if (!$blog) return null;
        $blog->update($data);
        return $blog;
    }

    public function delete(int $id): bool
    {
        $blog = Blog::find($id);
        if (!$blog) return false;
        return $blog->delete();
    }
}
