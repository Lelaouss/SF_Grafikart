<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
	private $_repository;
	
	public function __construct(PropertyRepository $repository)
	{
		$this->_repository = $repository;
	}
	
	/**
	 * @return Response
	 */
	public function index(): Response
	{
		dd($this->_repository);
		
		return $this->render('property/index.html.twig', [
			'current_menu' => 'properties'
		]);
	}
}