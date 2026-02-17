<?php

namespace App\apis\blog\useCasesBase\create;

use App\apis\blog\_shared\models\Blog;

class CreateBlogService
{
    public function execute(array $data): Blog
    {
        return Blog::create($data);
    }
}
