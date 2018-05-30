<?php

namespace App\Controller;

use App\Model\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        $news = new News();
        $xmlNews = $news->getXMLNews();

        $i = 0;
        $arrayNews = $tempNews = [];
        foreach ($xmlNews->news as $tNews) {
            $tempNews[] = $tNews;
        }

        krsort($tempNews);

        foreach ($tempNews as $news) {
            if ($i <= 2) {
                $arrayNews[] = $news;
            }

            $i++;
        }


        return $this->render('main/index.html.twig', array("news" => $arrayNews ?? array()));
    }

    /**
     * @Route("/translation")
     * @Method({"GET"})
     */
    public function translation()
    {
        return $this->render('main/translation.html.twig');
    }
}