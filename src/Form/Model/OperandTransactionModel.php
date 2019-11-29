<?php

declare(strict_types=1);

namespace App\Form\Model;

use App\Entity\Landlord\Operand;
use App\Entity\Tenant\Wallet;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @author Konstantin Grachev <me@grachevko.ru>
 */
final class OperandTransactionModel
{
    public ?int $id;

    /**
     * @Assert\NotBlank
     */
    public Operand $recipient;

    public ?string $description;

    public Money $amount;

    public bool $increment = false;

    public ?Wallet $wallet;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context): void
    {
        if ($this->amount->isNegative()) {
            $context->buildViolation('Сумма должна быть больше нуля.')
                ->atPath('amount')
                ->addViolation();
        }
    }
}