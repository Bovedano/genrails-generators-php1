<?php

namespace App\apis\blog\useCasesBase\delete;

use App\apis\blog\_shared\models\Blog;

class DeleteBlogService
{
    public function execute(int $id): bool
    {
        $blog = Blog::find($id);
        if (!$blog) return false;
        return $blog->delete();
    }
}
