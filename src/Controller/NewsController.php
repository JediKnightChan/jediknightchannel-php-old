<?php

namespace App\Controller;

use App\Model\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NewsController extends Controller
{
    /**
     * @Route("/news/")
     * @Method({"GET"})
     */
    public function index()
    {
        $news = new News();
        $xmlNews = $news->getXMLNews();

        $arrayNews = [];
        foreach ($xmlNews->news as $news) {
            $arrayNews[] = $news;
        }

        krsort($arrayNews);
        return $this->render('main/projects.html.twig', array("news" => $arrayNews ?? array()));
    }

    /**
     * @Route("/news/{url}")
     * @Method({"GET"})
     */
    public function read($url)
    {
        $news = new News();
        $xmlNews = $news->getXMLNews();

        $arrayNews = [];
        foreach ($xmlNews->news as $news) {
            if ($news->url == $url) {
                $arrayNews = $news;
            }
        }

        return $this->render('news/index.html.twig', array("news" => $arrayNews ?? array()));
    }
}