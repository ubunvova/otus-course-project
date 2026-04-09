<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ArgumentResolver;

use App\UserInterface\Api\BodyRequestInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

use function array_key_exists;
use function count;
use function is_string;

final readonly class BodyRequestResolver implements ValueResolverInterface
{
    public function __construct(
        private DenormalizerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    /**
     * @throws ReflectionException
     *
     * @return iterable<int, mixed>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $type = $argument->getType();

        if (!is_subclass_of($type, BodyRequestInterface::class)) {
            return [];
        }

        $contentType = $request->headers->get('Content-Type', '');

        if (str_starts_with($contentType, 'multipart/form-data')) {

            $data = $request->request->all();

            foreach ($data as $key => $value) {
                if (is_string($value) && $this->looksLikeJson($value)) {
                    $decoded = json_decode($value, true);
                    $data[$key] = $decoded ?? $value;
                }
            }

        } else {
            $data = json_decode($request->getContent(), true) ?? [];
        }

        $reflection = new ReflectionClass($type);
        $constructor = $reflection->getConstructor();

        foreach ($constructor->getParameters() as $param) {
            $name = $param->getName();

            if (!array_key_exists($name, $data)) {
                $data[$name] = null;
            }
        }

        try {
            $dto = $this->serializer->denormalize($data, $type);
        } catch (Throwable $e) {
            throw new BadRequestHttpException('Invalid request body: ' . $e->getMessage());
        }

        $violations = $this->validator->validate($dto);

        if (count($violations) > 0) {
            throw new BadRequestHttpException('Invalid request body');
        }

        yield $dto;
    }

    private function looksLikeJson(string $value): bool
    {
        $trim = mb_trim($value);

        return str_starts_with($trim, '{') || str_starts_with($trim, '[');
    }
}
