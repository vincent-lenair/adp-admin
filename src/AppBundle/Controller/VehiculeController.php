<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Vehicule;
use AppBundle\Form\Type\VehiculeType;

class VehiculeController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $vehicule = new Vehicule();

        $form = $this->createForm(VehiculeType::class, $vehicule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('adp.vehicules.manager')->save($vehicule);
            return $this->redirectToRoute('vehicule_add');
        }

        return $this->render('vehicules/add_vehicule.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $vehiculeId = $request->attributes->get('vehicule_id');
        $this->get('adp.vehicules.manager')->delete($vehiculeId);
        return $this->redirectToRoute('vehicule_list');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request)
    {

        $vehiculeId = $request->attributes->get('vehicule_id');
        $vehicule = $this->get('adp.vehicules.manager')->find($vehiculeId);

        $form = $this->createForm(VehiculeType::class, $vehicule);


        if($request->isMethod('POST')){

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->get('adp.vehicules.manager')->save($vehicule);
                return $this->redirectToRoute('vehicule_add');
            }

        }

        return $this->render('vehicules/add_vehicule.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $vehicules = $this->get('adp.vehicules.manager')->getVehicules();
        return $this->render('vehicules/list_vehicule.html.twig', array(
            'vehicules'=>$vehicules
        ));
    }
}
