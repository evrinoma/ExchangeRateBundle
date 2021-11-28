<?php

namespace Evrinoma\ExchangeRateBundle\Controller;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeCannotBeSavedException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeInvalidException;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Manager\Type\CommandManagerInterface;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManagerInterface;
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

final class TypeApiController extends AbstractApiController implements ApiControllerInterface
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
     * @Rest\Post("/api/exchange_rate/type/create", options={"expose"=true}, name="api_create_type")
     * @OA\Post(
     *     tags={"exchange_rate"},
     *     description="the method perform create type",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\ExchangeRateBundle\Dto\TypeApiDto",
     *                  "identity":"RUB",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto"),
     *               @OA\Property(property="identity",type="string")
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Create type")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var TypeApiDtoInterface $typeApiDto */
        $typeApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $this->commandManager->setRestCreated();
        try {
            $json = [];
            $em   = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($typeApiDto, $commandManager, &$json) {
                    $json = $commandManager->post($typeApiDto);
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_post_type')->json(['message' => 'Create type', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Put("/api/exchange_rate/type/save", options={"expose"=true}, name="api_save_type")
     * @OA\Put(
     *     tags={"exchange_rate"},
     *     description="the method perform save type for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Evrinoma\ExchangeRateBundle\Dto\TypeApiDto",
     *                  "id":"48",
     *                  "identity":"EUR",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="identity",type="string")
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Save type")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var TypeApiDtoInterface $typeApiDto */
        $typeApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        try {
            if ($typeApiDto->hasId()) {
                $json = [];
                $em   = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($typeApiDto, $commandManager, &$json) {
                        $json = $commandManager->put($typeApiDto);
                    }
                );
            } else {
                throw new TypeInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_put_type')->json(['message' => 'Save type', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Delete("/api/exchange_rate/type/delete", options={"expose"=true}, name="api_delete_type")
     * @OA\Delete(
     *     tags={"exchange_rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto",
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
     * @OA\Response(response=200,description="Delete type")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var TypeApiDtoInterface $typeApiDto */
        $typeApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $commandManager   = $this->commandManager;
        $this->commandManager->setRestAccepted();

        try {
            if ($typeApiDto->hasId()) {
                $json = [];
                $em   = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($typeApiDto, $commandManager, &$json) {
                        $commandManager->delete($typeApiDto);
                        $json = ['OK'];
                    }
                );
            } else {
                throw new TypeInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->json(['message' => 'Delete type', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/exchange_rate/type/criteria", options={"expose"=true}, name="api_type_criteria")
     * @OA\Get(
     *     tags={"exchange_rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="identity",
     *         in="query",
     *         name="identity",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return type")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var TypeApiDtoInterface $typeApiDto */
        $typeApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->criteria($typeApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_type')->json(['message' => 'Get type', 'data' => $json], $this->queryManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/exchange_rate/type", options={"expose"=true}, name="api_type")
     * @OA\Get(
     *     tags={"exchange_rate"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Evrinoma\ExchangeRateBundle\Dto\TypeApiDto",
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
     * @OA\Response(response=200,description="Return type")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var TypeApiDtoInterface $typeApiDto */
        $typeApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->get($typeApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_type')->json(['message' => 'Get type', 'data' => $json], $this->queryManager->getRestStatus());
    }

    public function setRestStatus(RestInterface $manager, \Exception $e): array
    {
        switch (true) {
            case $e instanceof TypeCannotBeSavedException:
                $manager->setRestNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $manager->setRestConflict();
                break;
            case $e instanceof TypeNotFoundException:
                $manager->setRestNotFound();
                break;
            case $e instanceof TypeInvalidException:
                $manager->setRestUnprocessableEntity();
                break;
            default:
                $manager->setRestBadRequest();
        }

        return ['errors' => $e->getMessage()];
    }
}