<?php 

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use App\Validator\ImageUrlValidator;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::TARGET_PARAMETER)]
class ImageUrl extends Constraint
{
    public $message = 'This URL does not point to a valid image.';

    public function validatedBy(): string
    {
        return ImageUrlValidator::class;
    }
}
