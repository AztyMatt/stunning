<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

#[\Attribute]
class ImageUrlValidator extends ConstraintValidator
{
    private array $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'];

    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!$this->isImageUrl($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    public function isImageUrl(?string $url): bool
    {
        if (!$url || filter_var($url, FILTER_VALIDATE_URL) === false || !preg_match('/^https?:\/\//i', $url)) {
            return false;
        }

        $pathInfo = pathinfo($url);

        return isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $this->imageExtensions);
    }
}
