<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
	private $_repository;
	private $_em;
	
	public function __construct(PropertyRepository $repository, ObjectManager $em)
	{
		$this->_repository = $repository;
		$this->_em = $em;
	}
	
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return $this->render('property/index.html.twig', [
			'current_menu' => 'properties'
		]);
	}
	
	/**
	 * @param Property $property
	 * @param string   $slug
	 * @return Response
	 */
	public function show(Property $property, string $slug): Response
	{
		if ($property->getSlug() !== $slug) {
			return $this->redirectToRoute('property_show_path', [
				'id' => $property->getId(),
				'slug' => $property->getSlug()
			], 301);
		}
		
		return $this->render('property/show.html.twig', [
			'property' => $property,
			'current_menu' => 'properties'
		]);
	}
}