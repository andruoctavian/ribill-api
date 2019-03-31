<?php

namespace App\Controller;

use App\Entity\Metric;
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
 * Class MetricController
 * @package App\Controller
 */
class MetricController extends AbstractController
{
    /**
     * @param Service $service
     * @param SessionInterface $session
     * @param DatabaseService $databaseService
     * @param NormalizerInterface $normalizer
     * @return JsonResponse
     */
    public function list(
        Service $service,
        SessionInterface $session,
        DatabaseService $databaseService,
        NormalizerInterface $normalizer
    ): JsonResponse {
        if ($session->isStarted()) {
            $session->save();
        }

        /** @var Metric[] $metrics */
        $metrics = $databaseService->findBy(Metric::class, ['service' => $service]);

        $normalizedMetrics = array_map(function (Metric $metric) use ($normalizer) {
            $normalizedMetric = $normalizer->normalize($metric);
            $normalizedMetric['service'] = $metric->getService()->getName();
            $normalizedMetric['api url'] = $metric->getApiUrl();

            return $normalizedMetric;
        }, $metrics);

        return $this->json($normalizedMetrics);
    }

    /**
     * @param Service $service
     * @param SessionInterface $session
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param DatabaseService $databaseService
     * @return JsonResponse
     */
    public function add(
        Service $service,
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
            /** @var Metric $metric */
            $metric = $serializer->deserialize($data, Metric::class, JsonEncoder::FORMAT);
            $metric->setService($service);
            $databaseService->save($metric);
        }

        return $this->json($data);
    }
}