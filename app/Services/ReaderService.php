<?php

namespace App\Services;

use App\Article;
use App\Journal;
use App\Release;
use Illuminate\Support\Facades\File;

class ReaderService
{
    /**
     * Release
     */
    private $oRelease;

    /**
     * Директория с html статьями
     *
     * @var string
     */
    private $pathToHtml = 'resources/views/reader/html/';

    /**
     * ReaderService constructor.
     */
    public function __construct()
    {

    }

    /**
     * Поиск по релизу
     *
     * @param Release $oRelease
     * @return $this
     */
    public function byRelease(Release $oRelease): ReaderService
    {
        $this->oRelease = $oRelease;
        return $this;
    }

    /**
     * Журнал релиза
     *
     * @return Journal
     */
    public function getJournal(): Journal
    {
        return $this->oRelease->journal;
    }

    /**
     * Статьи для читалки по релизу со вставкой html кода
     *
     * @return mixed
     */
    public function getArticles()
    {
        $oArticles = $this->oRelease->articles()->with('authors', 'translations', 'authors.translations')->get();

        $oArticles = $oArticles->transform(function ($item) {
            $item->html = $this->getArticleHtml($item);
            return $item;
        });

        return $oArticles;
    }

    /**
     * Релизы для вкладке Библиотека
     *
     * @return mixed
     */
    public function getReleases()
    {
        $oReleases = Release::with('translations')->where('id', '<>', $this->oRelease->id)->get();

        $oReleases = $oReleases->transform(function ($item) {

            $item->image = asset('img/covers/9051c8d54a4e0d8c0629ba88c2ff292f.png');

            return $item;
        });

        return $oReleases;
    }

    /**
     * Директория для html статей
     *
     * @param string $path
     * @return ReaderService
     */
    public function setPathToHtml(string $path): ReaderService
    {
        $this->pathToHtml = $path;

        return $this;
    }

    /**
     * Получить html по статье
     *
     * @param $oArticle
     * @return string
     */
    private function getArticleHtml(Article $oArticle): string
    {
        $path = base_path($this->pathToHtml);

        $name = 'article_00'.sprintf("%02d", $oArticle->id);

        $html = $name.'.html';

        $file = $path.$html;

        return File::exists($file) ? trim(file_get_contents($file)) : null;
    }

}