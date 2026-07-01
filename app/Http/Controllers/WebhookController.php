<?php

namespace App\Http\Controllers;

use App\Enum\BlogSource;
use App\Enum\BlogStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class WebhookController extends Controller
{
        public function handle(Request $request)
    {
        $expectedToken = config("app.auto_seo_bearer_token");
        $token = str_replace(
            'Bearer ',
            '',
            $request->header('Authorization')
        );

        if ($token !== $expectedToken) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        

        $this->saveArticles($request->all());

        return response()->json([
            'success' => true
        ]);
    }
        private function saveArticles($article): void
    {
        if($article['status']==BlogStatus::PUBLISHED->value){
        $content = $article['content_html'];

        // Extract the first paragraph from the HTML
        preg_match('/<p\b[^>]*>(.*?)<\/p>/is', $content, $matches);

        $excerpt = isset($matches[1])
            ? Str::limit(trim(strip_tags($matches[1])), 200)
            : Str::limit(trim(strip_tags($content)), 200);
          Blog::updateOrCreate(
            [
                'autoseo_id' => $article['id'],
            ],
            [
                'title' => $article['title'],
                'slug' => $article['slug'],
                'content' => $article['content_html'],
                'status' => $article['status'],
                'excerpt' => $excerpt,
                'description' => $article['metaDescription'],
                'published_at' => $article['publishedAt'] ?? null,
                'keywords' =>implode(', ', $article['keywords'] ?? []),
                'meta_keywords' => $article['metaKeywords'] ?? null,
                'word_count' => $article['word_count'] ?? null,
                'hero_image' => $article['heroImageUrl'] ?? null,
                'info_graphic_image' => $article['infographicImageUrl'] ?? null,
                'language' => $article['languageCode'] ?? 'en',
            ]
        );
  
        }

    }
}
