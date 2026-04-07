<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ArgumentResolver;

use App\UserInterface\Api\BodyRequestInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function count;

final class BodyRequestResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    /**
     * @return iterable<int, mixed>
     * @throws ExceptionInterface
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $type = $argument->getType();

        if (!is_subclass_of($type, BodyRequestInterface::class)) {
            return [];
        }

        try {
            $object = $this->serializer->deserialize(
                $request->getContent(),
                $type,
                'json',
            );
        } catch (Exception $e) {
            throw new BadRequestHttpException('Invalid request body: ' . $e->getMessage(), $e, 400);
        }

        $violations = $this->validator->validate($object);
        if (count($violations) > 0) {
            throw new BadRequestHttpException('Invalid request body', null, 400);
        }

        yield $object;
    }
}
