<?php

namespace App\Controller;

use App\Entity\Productoxpedidos;
use App\Form\ProductoxpedidosType;
use App\Repository\ProductoxpedidosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/productoxpedidos")
 */
class ProductoxpedidosController extends AbstractController
{
    /**
     * @Route("/", name="productoxpedidos_index", methods={"GET"})
     */
    public function index(ProductoxpedidosRepository $productoxpedidosRepository): Response
    {
        return $this->render('productoxpedidos/index.html.twig', [
            'productoxpedidos' => $productoxpedidosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="productoxpedidos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productoxpedido = new Productoxpedidos();
        $form = $this->createForm(ProductoxpedidosType::class, $productoxpedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productoxpedido);
            $entityManager->flush();

            return $this->redirectToRoute('productoxpedidos_index');
        }

        return $this->render('productoxpedidos/new.html.twig', [
            'productoxpedido' => $productoxpedido,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productoxpedidos_show", methods={"GET"})
     */
    public function show(Productoxpedidos $productoxpedido): Response
    {
        return $this->render('productoxpedidos/show.html.twig', [
            'productoxpedido' => $productoxpedido,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="productoxpedidos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Productoxpedidos $productoxpedido): Response
    {
        $form = $this->createForm(ProductoxpedidosType::class, $productoxpedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productoxpedidos_index');
        }

        return $this->render('productoxpedidos/edit.html.twig', [
            'productoxpedido' => $productoxpedido,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productoxpedidos_delete", methods={"DELETE"})
     */
    public function delete( $id, Request $request, Productoxpedidos $productoxpedido): Response
    {
        $idproducto= $request->request->get('idprod');
        if ($this->isCsrfTokenValid('delete'.$productoxpedido->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productoxpedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detalleprod', [
            "id" => $idproducto
        ]);
    }

    /**
     * @Route("/{id}/borrar", name="borrarCarrito", methods={"DELETE"})
     */
    public function borrarCarrito( $id, Request $request, Productoxpedidos $productoxpedido): Response
    {
       
        if ($this->isCsrfTokenValid('delete'.$productoxpedido->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productoxpedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carrito', [
            
        ]);
    }

    /**
     * @Route("/{id}/changeCantidad", name="changeCantidad", methods={"GET","POST"})
     */
    public function changeCantidad( $id, Request $request, Productoxpedidos $productoxpedido): Response
    {
        
        if ($this->isCsrfTokenValid('modify'.$productoxpedido->getId(), $request->request->get('_token'))) {
            $filtroP=$this->getDoctrine()
            ->getRepository(Productoxpedidos::Class)
            ->findAll();
            // $XV = -1;
            // foreach ($filtroP as $x) {
            //     $XV = $XV + 1;
            //     if ($x->get == $XV) {
                    
                // }
                
                
            // };
            $entityManager = $this->getDoctrine()->getManager();
            $productoxpedido->setCantidad($_POST['subject'.$id]);
            

            
            $entityManager->flush($productoxpedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carrito', [

        ]);
    }
}
