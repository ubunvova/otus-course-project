<?php

declare(strict_types=1);

namespace App\UserInterface\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder
{
    private const int NO_JSON_ENCODE_OPTIONS = 0;

    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function respondWith(ResponseInterface $response, int $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            data: $this->serializer->serialize($response, JsonEncoder::FORMAT, [JsonEncode::OPTIONS => self::NO_JSON_ENCODE_OPTIONS]),
            status: $status,
            json: true,
        );
    }
}
