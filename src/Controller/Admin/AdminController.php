<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    #[Route('', name: 'admin')]
    public function index(RouterInterface $router): Response
    {
        $routes = [];
        foreach ($router->getRouteCollection()->all() as $name => $route) {
            if (preg_match('/^app_.*_index$/', $name) && strpos($name, 'admin_') === false) {
                $formattedName = str_replace(['app_', '_index'], '', $name);
                $routes[] = [
                    'name' => $name,
                    'formattedName' => ucfirst($formattedName)
                ];
            }
        }

        return $this->render('admin/index.html.twig', [
            'adminRoutes' => $routes,
        ]);
    }
}
