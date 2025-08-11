<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
	/**
	 * @Route("/post", name="post_index")
	 */
	public function index(): Response
	{
		return new Response('<html><body>Post index</body></html>');
	}
}
