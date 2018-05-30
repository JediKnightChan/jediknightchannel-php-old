<?php

namespace App\Controller;

use App\Model\Contact;
use Core\Component\ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ContactController extends Controller
{
    private $secret = "6LeKWj8UAAAAAEsuSnZHwnViXgDrb_wZTU-eXdo3";
    private $resReCaptcha = null;

    /**
     * @Route("/contact/")
     * @Method({"GET", "POST"})
     */
    public function index()
    {
        $request = new Request();
        $contact = new Contact();
        $reCaptcha = new ReCaptcha($this->secret);

        $this->resReCaptcha = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $request->query->get('g-recaptcha-response')
        );

        if ($this->resReCaptcha != null && $this->resReCaptcha->success) {
            $contact->feedBack($_POST);
        }

        if(!empty($_POST)){
            $contact->feedBack($_POST);
        }

        return $this->render('contact/index.html.twig');
    }
}