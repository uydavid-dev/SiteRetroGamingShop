<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Service\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    private $entityManagerInterface;
    private $encoder;
    protected static $defaultName = 'app:create-user';

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->EntityManagerInterface = $entityManagerInterface;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure(): void
    {
            $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
                 ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();

        $user->setEmail($input->getArgument('username'));

        $password = $this->encoder->encodePassword($user, $input->getArgument('password'));
        $user->setPassword($password);
        
        $user->setRoles(['ROLE_VENDEUR'])
        (
            $this->userRepository->getVendeur()->getEmail(),
            $this->userRepository->getVendeur()->getNom() . ' ' . $this->userRepository->getVendeur()->getPrenom()
        );
        
        foreach ($user as $mail) {
            $email = (new Email())
                ->from($mail->getEmail())
                ->to($adress)
                ->subject('Nouveau message de ' . $mail->getNom())
                ->text($mail->getMessage());

            $this->mailer->send($email);

            $this->contactService->isSend($mail);
        }

        return Command::SUCCESS;
    }
}
