<?php

declare(strict_types=1);

namespace App\Appeal\Rest;

use App\Appeal\Entity\Calculator;
use App\Appeal\Entity\Cooperation;
use App\Appeal\Entity\Question;
use App\Appeal\Entity\Schedule;
use App\Appeal\Entity\TireFitting;
use App\Appeal\Rest\Dto\CalculatorDto;
use App\Appeal\Rest\Dto\CooperationDto;
use App\Appeal\Rest\Dto\QuestionDto;
use App\Appeal\Rest\Dto\ScheduleDto;
use App\Appeal\Rest\Dto\TireFittingDto;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/appeal")
 */
final class CreateController extends AbstractController
{
    private PhoneNumberUtil $phoneNumberUtil;

    public function __construct(PhoneNumberUtil $phoneNumberUtil)
    {
        $this->phoneNumberUtil = $phoneNumberUtil;
    }

    /**
     * @Route("/calc", methods={"POST"})
     */
    public function calc(CalculatorDto $dto, EntityManagerInterface $em): Response
    {
        /** @var PhoneNumber $phone */
        $phone = $this->phoneNumberUtil->parse($dto->phone);

        $em->persist(
            Calculator::create(
                $dto->name,
                $phone,
                $dto->body,
            ),
        );
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/schedule", methods={"POST"})
     */
    public function schedule(ScheduleDto $dto, EntityManagerInterface $em): Response
    {
        /** @var DateTimeImmutable $date */
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $dto->date);

        $em->persist(
            Schedule::create(
                $dto->name,
                $dto->email,
                $date,
            ),
        );
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/question", methods={"POST"})
     */
    public function question(QuestionDto $dto, EntityManagerInterface $em): Response
    {
        $em->persist(
            Question::create(
                $dto->name,
                $dto->email,
                $dto->question,
            ),
        );
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/cooperation", methods={"POST"})
     */
    public function cooperation(CooperationDto $dto, EntityManagerInterface $em): Response
    {
        /** @var PhoneNumber $phone */
        $phone = $this->phoneNumberUtil->parse($dto->phone);

        $em->persist(
            Cooperation::create(
                $dto->name,
                $phone,
            ),
        );
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/tire-fitting", methods={"POST"})
     */
    public function tireFitting(TireFittingDto $dto, EntityManagerInterface $em): Response
    {
        /** @var PhoneNumber $phone */
        $phone = $this->phoneNumberUtil->parse($dto->phone);

        $em->persist(
            TireFitting::create(
                $dto->name,
                $phone,
                $dto->body,
            ),
        );
        $em->flush();

        return new Response();
    }
}