<?php

namespace App;

use App\Entity\Emails;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    /**
     * @var ManagerRegistry
     */
    private $ManagerRegistry;
    /**
     * @var MailerInterface
     */
    private $MailerInterface;

    public function __construct(ManagerRegistry $ManagerRegistry, MailerInterface $MailerInterface)
    {
        $this->ManagerRegistry = $ManagerRegistry;
        $this->MailerInterface = $MailerInterface;
    }

    public function check_email(string $email): int
    {
        $value = $this->ManagerRegistry->getRepository(Emails::class)->findOneBy(["email" => $email]);
        if ($value->isChecked() == 1 && $value->isValid() == 1) {
            return 1;
        }
        return 0;
    }

    public function send_email(string $username)
    {
        echo "1";
        $email = (new Email())
            ->from("from@example.ru")
            ->to("to@example.ru")
            ->subject("Subscription")
            ->text($username . ", your subscription is expiring soon");
        $this->MailerInterface->send($email);
    }
}