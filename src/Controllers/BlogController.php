<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BladeViewRenderer;
use App\Services\BlogService;

/**
 * Blog da IBNP (Spec 25): guias práticos de direitos, serviços e vida em Guapó.
 */
final class BlogController
{
    private BladeViewRenderer $renderer;
    private BlogService $blog;
    private string $baseDir;

    public function __construct(?BladeViewRenderer $renderer = null, ?BlogService $blog = null, ?string $baseDir = null)
    {
        $this->baseDir = $baseDir ?? dirname(__DIR__, 2);
        $this->renderer = $renderer ?? new BladeViewRenderer("{$this->baseDir}/views", "{$this->baseDir}/storage/cache/views");
        $this->blog = $blog ?? new BlogService("{$this->baseDir}/data/blog");
    }

    /** GET /blog */
    public function index(): void
    {
        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.blog.index', [
            'posts' => $this->blog->all(),
            'currentRoute' => '/blog',
        ]);
    }

    /** GET /blog/{slug} */
    public function show(string $slug): void
    {
        $post = $this->blog->find($slug);
        if ($post === null) {
            (new PageController($this->renderer, $this->baseDir))->notFound();

            return;
        }

        $relacionados = array_values(array_filter(
            $this->blog->all(),
            fn ($outro): bool => $outro->slug !== $post->slug,
        ));

        header('Content-Type: text/html; charset=utf-8');
        echo $this->renderer->render('pages.blog.post', [
            'post' => $post,
            'relacionados' => array_slice($relacionados, 0, 3),
            'currentRoute' => $post->url(),
        ]);
    }
}
