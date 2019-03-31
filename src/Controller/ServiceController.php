<?php

namespace App\Controller;

use App\Entity\Service;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ServiceController
 * @package App\Controller
 */
class ServiceController extends AbstractController
{
    /**
     * @param SessionInterface $session
     * @param DatabaseService $databaseService
     * @param NormalizerInterface $normalizer
     * @return JsonResponse
     */
    public function list(
        SessionInterface $session,
        DatabaseService $databaseService,
        NormalizerInterface $normalizer
    ): JsonResponse {
        if ($session->isStarted()) {
            $session->save();
        }

        /** @var Service[] $services */
        $services = $databaseService->findAll(Service::class);

        $normalizedServices = array_map(function (Service $service) use ($normalizer) {
            return $normalizer->normalize($service);
        }, $services);


        return $this->json($normalizedServices);
    }

    /**
     * @param SessionInterface $session
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param DatabaseService $databaseService
     * @return JsonResponse
     */
    public function add(
        SessionInterface $session,
        Request $request,
        SerializerInterface $serializer,
        DatabaseService $databaseService
    ): JsonResponse {
        if ($session->isStarted()) {
            $session->save();
        }

        $data = $request->getContent();
        if (!empty($data)) {
            /** @var Service $service */
            $service = $serializer->deserialize($data, Service::class, JsonEncoder::FORMAT);
            $databaseService->save($service);
        }

        return $this->json($data);
    }
}