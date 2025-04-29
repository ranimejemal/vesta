<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyContollerController extends AbstractController
{
    /**
     * @Route("/search", name="property_search")
     */
    public function search(Request $request): Response
    {
        $criteria = [];
        $priceMin = $request->query->get('price_min');
        $priceMax = $request->query->get('price_max');
        $type = $request->query->get('type');
        $areaMin = $request->query->get('area_min');

        if ($priceMin) {
            $criteria['price'] = ['min' => $priceMin];
        }
        if ($priceMax) {
            $criteria['price'] = ['max' => $priceMax];
        }
        if ($type) {
            $criteria['type'] = $type;
        }
        if ($areaMin) {
            $criteria['area'] = ['min' => $areaMin];
        }

        // Query the properties based on the criteria
        $properties = $this->getDoctrine()->getRepository(Property::class)->findByCriteria($criteria);

        return $this->render('property/search.html.twig', [
            'properties' => $properties
        ]);
    }
}

