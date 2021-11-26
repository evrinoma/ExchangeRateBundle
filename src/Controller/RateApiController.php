<?php

namespace Evrinoma\ExchangeRateBundle\Controller;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\RateCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Exception\RateInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\RateNotFoundException;
use Evrinoma\ExchangeRateBundle\Manager\Rate\CommandManagerInterface;
use Evrinoma\ExchangeRateBundle\Manager\Rate\QueryManagerInterface;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\UtilsBundle\Controller\AbstractApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

final class RateApiController extends AbstractApiController implements ApiControllerInterface
{
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface|RestInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface|RestInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;

    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, FactoryDtoInterface $factoryDto, CommandManagerInterface $commandManager, QueryManagerInterface $queryManager, string $dtoClass)
    {
        parent::__construct($serializer);
        $this->request        = $requestStack->getCurrentRequest();
        $this->factoryDto     = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager   = $queryManager;
        $this->dtoClass       = $dtoClass;
    }

    /**
     * @Rest\Post("/api/rate/create", options={"expose"=true}, name="api_create_rate")
     * @OA\Post(
     *     tags={"rate"},
     *     description="the method perform create rate",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\ExchangeRateBundle\Dto\RateApiDto",
     *                  "id":"48",
     *                  "description":"Интертех",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\ExchangeRateBundle\Dto\RateApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="description",type="string"),
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Create rate")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var RateApiDtoInterface $rateApiDto */
        $rateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $this->commandManager->setRestCreated();
        try {
            $json = [];
            $em   = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($rateApiDto, $commandManager, &$json) {
                    $json = $commandManager->post($rateApiDto);
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_post_rate')->json(['message' => 'Create rate', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Put("/api/rate/save", options={"expose"=true}, name="api_save_rate")
     * @OA\Put(
     *     tags={"rate"},
     *     description="the method perform save rate for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\ExchangeRateBundle\Dto\RateApiDto",
     *                  "active": "b",
     *                  "id":"48",
     *                  "description":"Интертех",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\ExchangeRateBundle\Dto\RateApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="description",type="string"),
     *               @OA\Property(property="active",type="string")
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Save rate")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var RateApiDtoInterface $rateApiDto */
        $rateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        try {
            if ($rateApiDto->hasId()) {
                $json = [];
                $em   = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($rateApiDto, $commandManager, &$json) {
                        $json = $commandManager->put($rateApiDto);
                    }
                );
            } else {
                throw new RateInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_put_rate')->json(['message' => 'Save rate', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Delete("/api/rate/delete", options={"expose"=true}, name="api_delete_rate")
     * @OA\Delete(
     *     tags={"rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\RateApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Delete rate")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var RateApiDtoInterface $rateApiDto */
        $rateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $commandManager   = $this->commandManager;
        $this->commandManager->setRestAccepted();

        try {
            if ($rateApiDto->hasId()) {
                $json = [];
                $em   = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($rateApiDto, $commandManager, &$json) {
                        $commandManager->delete($rateApiDto);
                        $json = ['OK'];
                    }
                );
            } else {
                throw new RateInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->json(['message' => 'Delete rate', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/rate/criteria", options={"expose"=true}, name="api_rate_criteria")
     * @OA\Get(
     *     tags={"rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\RateApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="description",
     *         in="query",
     *         name="description",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return rate")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var RateApiDtoInterface $rateApiDto */
        $rateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->criteria($rateApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_rate')->json(['message' => 'Get rate', 'data' => $json], $this->queryManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/rate", options={"expose"=true}, name="api_rate")
     * @OA\Get(
     *     tags={"rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\RateApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return rate")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var RateApiDtoInterface $rateApiDto */
        $rateApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->get($rateApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_rate')->json(['message' => 'Get rate', 'data' => $json], $this->queryManager->getRestStatus());
    }

    public function setRestStatus(RestInterface $manager, \Exception $e): array
    {
        switch (true) {
            case $e instanceof RateCannotBeSavedException:
                $manager->setRestNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $manager->setRestConflict();
                break;
            case $e instanceof RateNotFoundException:
                $manager->setRestNotFound();
                break;
            case $e instanceof RateInvalidException:
                $manager->setRestUnprocessableEntity();
                break;
            default:
                $manager->setRestBadRequest();
        }

        return ['errors' => $e->getMessage()];
    }
}