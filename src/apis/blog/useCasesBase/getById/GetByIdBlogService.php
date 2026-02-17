<?php

namespace App\apis\blog\useCasesBase\getById;

use App\apis\blog\_shared\models\Blog;

class GetByIdBlogService
{
    public function execute(int $id): ?Blog
    {
        return Blog::find($id);
    }
}
