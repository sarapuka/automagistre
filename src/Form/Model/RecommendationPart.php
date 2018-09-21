<?php

declare(strict_types=1);

namespace App\Form\Model;

use App\Entity\CarRecommendation;
use App\Entity\CarRecommendationPart;
use App\Entity\Part;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Konstantin Grachev <me@grachevko.ru>
 */
final class RecommendationPart extends Model
{
    /**
     * @var CarRecommendation
     *
     * @Assert\NotBlank
     */
    public $recommendation;

    /**
     * @var Part
     *
     * @Assert\NotBlank
     */
    public $part;

    /**
     * @var int
     *
     * @Assert\NotBlank
     */
    public $quantity;

    /**
     * @var Money
     *
     * @Assert\NotBlank
     */
    public $price;

    public static function getEntityClass(): string
    {
        return CarRecommendationPart::class;
    }
}
