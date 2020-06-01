<?php

namespace App\Controller;

use App\Entity\CuentasBank;
use App\Form\CuentasBankType;
use App\Repository\CuentasBankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cuentas/bank")
 */
class CuentasBankController extends AbstractController
{
    /**
     * @Route("/", name="cuentas_bank_index", methods={"GET"})
     */
    public function index(CuentasBankRepository $cuentasBankRepository): Response
    {
        return $this->render('cuentas_bank/index.html.twig', [
            'cuentas_banks' => $cuentasBankRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cuentas_bank_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cuentasBank = new CuentasBank();
        $form = $this->createForm(CuentasBankType::class, $cuentasBank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuentasBank);
            $entityManager->flush();

            return $this->redirectToRoute('cuentas_bank_index');
        }

        return $this->render('cuentas_bank/new.html.twig', [
            'cuentas_bank' => $cuentasBank,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuentas_bank_show", methods={"GET"})
     */
    public function show(CuentasBank $cuentasBank): Response
    {
        return $this->render('cuentas_bank/show.html.twig', [
            'cuentas_bank' => $cuentasBank,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cuentas_bank_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CuentasBank $cuentasBank): Response
    {
        $form = $this->createForm(CuentasBankType::class, $cuentasBank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cuentas_bank_index');
        }

        return $this->render('cuentas_bank/edit.html.twig', [
            'cuentas_bank' => $cuentasBank,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuentas_bank_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CuentasBank $cuentasBank): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuentasBank->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cuentasBank);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cuentas_bank_index');
    }
}
