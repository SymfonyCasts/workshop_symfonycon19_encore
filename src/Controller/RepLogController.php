<?php

namespace App\Controller;

use App\Entity\RepLog;
use App\Form\Type\RepLogType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RepLogController extends BaseController
{
    /**
     * @Route("/reps", name="rep_log_list", options={"expose" = true}, methods={"GET"})
     */
    public function getRepLogsAction()
    {
        $models = $this->findAllUsersRepLogModels();

        return $this->createApiResponse([
            'items' => $models
        ]);
    }

    /**
     * @Route("/reps/{id}", name="rep_log_get", methods={"GET"})
     */
    public function getRepLogAction(RepLog $repLog)
    {
        $apiModel = $this->createRepLogApiModel($repLog);

        return $this->createApiResponse($apiModel);
    }

    /**
     * @Route("/reps/{id}", name="rep_log_delete", methods={"DELETE"})
     */
    public function deleteRepLogAction(RepLog $repLog)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        $em = $this->getDoctrine()->getManager();
        $em->remove($repLog);
        $em->flush();

        return new Response(null, 204);
    }

    /**
     * @Route("/reps", name="rep_log_new", options={"expose" = true}, methods={"POST"})
     */
    public function newRepLogAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            throw new BadRequestHttpException('Invalid JSON');
        }

        $form = $this->createForm(RepLogType::class, null, [
            'csrf_protection' => false,
        ]);
        $form->submit($data);
        if (!$form->isValid()) {
            $errors = $this->getErrorsFromForm($form);

            return $this->createApiResponse([
                'errors' => $errors
            ], 400);
        }

        /** @var RepLog $repLog */
        $repLog = $form->getData();
        $repLog->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($repLog);
        $em->flush();

        $apiModel = $this->createRepLogApiModel($repLog);

        //$response = $this->createApiResponse($apiModel);
        $response = new Response(null, 204);
        // setting the Location header... it's a best-practice
        $response->headers->set(
            'Location',
            $this->generateUrl('rep_log_get', ['id' => $repLog->getId()])
        );

        return $response;
    }
}