<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UserController
 */
class UserController extends AbstractFOSRestController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Rest\Get(path = "/users")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @return User[]
     */
    public function getAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * @Rest\Get(path = "/users/{id}")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @param User $user
     * @return User|null
     */
    public function getOne(User $user)
    {
        if (null === $user) {
            throw new NotFoundHttpException('L\'utilisateur demandé n\'a pas été trouvé.');
        }

        return $user;
    }

    /**
     * @Rest\Post(path = "/users")
     * @Rest\View(StatusCode=Response::HTTP_CREATED)
     *
     * @param Request $request
     * @return User|FormInterface
     * @throws ORMException
     */
    public function post(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->save($user);

            return $user;
        }

        return $form;
    }
}
