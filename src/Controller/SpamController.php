<?php


namespace App\Controller;


use App\Entity\Users;
use App\Services\SpamSender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api",name="api_")
 */
class SpamController extends AbstractController
{
    /**
     * @Route("/v2/main", name="main_page", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        return $this->render('index.html.twig');
    }

    /**
     * @param SpamSender $spamSender
     * @return Response
     * @Route("/v2/send_code", name="mobile_auth_page", methods={"GET"})
     */
    public function sendToLentaRu(SpamSender $spamSender)
    {
        $phone = $_GET['phone'];
        $payload = json_encode(array("phone" => $phone));
        $url = "https://lenta.com/api/v1/authentication/requestValidationCode?";
        $spamSender->sender($url, $payload);
        return $res = new Response();
    }
}