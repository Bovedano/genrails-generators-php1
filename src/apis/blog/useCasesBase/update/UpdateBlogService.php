<?php

namespace App\apis\blog\useCasesBase\update;

use App\apis\blog\_shared\models\Blog;

class UpdateBlogService
{
    public function execute(int $id, array $data): ?Blog
    {
        $blog = Blog::find($id);
        if (!$blog) return null;
        $blog->update($data);
        return $blog;
    }
}
