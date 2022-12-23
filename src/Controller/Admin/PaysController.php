<?php

namespace App\Controller\Admin;

use App\Entity\Paye;
use App\Form\PaysType;
use App\Repository\PayeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\ByteString;

// créer un préfixe aux routes du contrôleur
#[Route('/admin')]
class PaysController extends AbstractController
{
	public function __construct(private PayeRepository $payeRepository, 
	private RequestStack $requestStack, private EntityManagerInterface $entityManager
	)
	{}

	#[Route('/pays', name: 'admin.pays.index')]
	public function index():Response
	{
		return $this->render('admin/pays/index.html.twig', [
			'entities' => $this->payeRepository->findAll(),
		]);
	}

	#[Route('/pays/form/add', name: 'admin.pays.form.add')]
	#[Route('/pays/form/edit/{id}', name: 'admin.pays.form.edit')]
	public function form(int $id = null):Response
	{
		$type = PaysType::class;
		
		// si l'id est nul, un joueur est en phase de création
		// si l'id n'est pas nul, un joueur est en phase de modification
		$model = $id ? $this->payeRepository->find($id) : new Paye();

		// sauvegarder le nom de l'image au cas où aucune image n'a été sélectionnée dans le formulaire
		$model->prevImage = $id ? $model->getDrapeau() : null;
		// dd($model);

		$form = $this->createForm($type, $model);
		$form->handleRequest( $this->requestStack->getCurrentRequest() );

		if($form->isSubmitted() && $form->isValid()){
			// dd($model);
			// dd($form['portrait']->getData());

			// si une image a été sélectionnée
			if( $form['drapeau']->getData() instanceof UploadedFile ){
				$file = $form['drapeau']->getData(); // objet de type UploadedFile

				// générer un nom aléatoire
				$randomName = ByteString::fromRandom(32)->lower();
				$fileExtension = $file->guessClientExtension();
				$fullFileName = "$randomName.$fileExtension";

				// déplacer le fichier
				$file->move('img/', $fullFileName);

				// affecter le nom aléatoire à la propriété de l'entité
				$model->setDrapeau( $fullFileName );
				// dd($randomName, $fileExtension, $fullFileName);

				// supprimer l'ancienne image: uniquement en phase de modification
				if($id) unlink("img/{$model->prevImage}");
			}
			// si aucune image n'a été sélectionnée : récupération de l'image stockée dans la propriété dynamique prevImage
			else {
				$model->setDrapeau( $model->prevImage );
			}

			// accéder à la base données
			$this->entityManager->persist($model);
			$this->entityManager->flush();

			// création d'un message flash en session
			$message = $id ? 'Ntional Team has been updated' : 'National Team has been added';
			$this->addFlash('notice', $message);

			// redirection
			return $this->redirectToRoute('admin.pays.index');
		}

		return $this->render('admin/pays/form.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/pays/remove/{id}', name: 'admin.pays.remove')]
	public function remove(int $id):Response
	{
		// sélection de l'entité à supprimer
		$entity = $this->payeRepository->find($id);

		// supprimer l'entité
		$this->entityManager->remove($entity);
		$this->entityManager->flush();

		// message flash et redirection
		$this->addFlash('notice', 'National Team has been removed');
		return $this->redirectToRoute('admin.pays.index');
	}
}