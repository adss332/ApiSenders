<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SenderSort;
class DefaultController extends AbstractController {
#[Route('/api/senders')]
 public function Senders(Request $request, SenderSort $sort): Response {

    $users = json_decode($request->get('users'));
    $message = $request->get('message');

    if (!empty($users) && !empty($message)) {
        $trust_or_not = 'Start sender';
        $sort->handle($users,$message);
    } else {
        $trust_or_not = 'You dont have users or message in your request';
    }

    return $this->json($trust_or_not);
 }
}