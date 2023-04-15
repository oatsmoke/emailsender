<?php

namespace App\Controller;

use App\EmailService;
use App\Entity\Users;
use DateInterval;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @var EmailService
     */
    private $EmailService;

    public function __construct(EmailService $EmailService)
    {
        $this->EmailService = $EmailService;
    }

    /**
     * @Route("/check_subscription", name="app_check_subscription")
     */
    public function check_subscription(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(Users::class)->findAll();
        if ($users) {
            $dateCheck = (new DateTime())
                ->add(new DateInterval("P3D"));
            $strDateCheck = $dateCheck->format('Y-m-d H:i:s');
            foreach ($users as $user) {
                $strDateUser = $user->getValidts()->format('Y-m-d H:i:s');
                if ($user->isConfirmed() == 1 && $strDateUser < $strDateCheck) {
                    if ($this->EmailService->check_email($user->getEmail()) == 1) {
                        $this->EmailService->send_email($user->getUsername());
                    }
                }
            }
        }
        return new Response();
    }
}
