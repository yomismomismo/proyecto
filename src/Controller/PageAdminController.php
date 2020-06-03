<?php

namespace App\Controller;
use App\Entity\{Usuario, Pedidos, Producto, Productoxpedidos, Comentario, Admin};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\{ProductoType, UsuarioType};
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\{MensajeRepository, PedidosRepository, UsuarioRepository, ComentarioRepository, ProductoRepository};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
class PageAdminController extends AbstractController
{
        /**
     * @Route("/page/admin", name="page_admin")
     */
    public function index(Request $request, SessionInterface $session)
    {
        $week = 10;
        $user1 = $session->get('nombre_usuario');
        $numUsers= $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findAll();
        $contadorUser=0;
        foreach ($numUsers as $user) {
            $contadorUser=$contadorUser+1;
        }
        $numUPedidos= $this->getDoctrine()
        ->getRepository(Pedidos::class)
        ->findBy(["estado" => "completado"]);
        $contadorPedidos=0;
        foreach ($numUPedidos as $pedido) {
            $contadorPedidos=$contadorPedidos+1;
        }
        $numComentarios= $this->getDoctrine()
        ->getRepository(Comentario::class)
        ->findAll();
        $contadorComentarios=0;
        foreach ($numComentarios as $comentario) {
            $contadorComentarios=$contadorComentarios+1;
        }
        $productofiltro= $this->getDoctrine()
        ->getRepository(Producto::class)
        ->findAll(["unidades_venidas" => "des"]);
            
        if ($user1) {
            return $this->render('adminPage/indexAdmin.html.twig', [
                'controller_name' => 'PageAdminController',
                "numUsuarios" => $contadorUser,
                "numPedidos" => $contadorPedidos,
                "numComentarios" => $contadorComentarios,
                "productofiltro" => $productofiltro
                 ]);

        }
        else{
            return $this->render('adminPage/loginAdmin.html.twig', [
                'controller_name' => 'PageAdminController',

                 ]);
        }
                  
                   }
    
    //--------------------------------------------------------------------------------
                   
    /**
     * @Route("/page/admin/productosAdmin", name="productosAdmin")
     */
    public function productosAdmin(ProductoRepository $productoRepository, ComentarioRepository $comentarioRepository,Request $request, SessionInterface $session )
    {

        $user1 = $session->get('nombre_usuario');
        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
            'productos' => $productoRepository->findAll(),
            'comentario' => $comentarioRepository->findAll(),
            
        ]);
    }
    /**
     * @Route("/page/admin/deletecoment/{id}", name="deletecom")
     */
    public function deletecom(ProductoRepository $productoRepository, ComentarioRepository $comentarioRepository )
    {

        $user1 = $session->get('nombre_usuario');
        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
            'productos' => $productoRepository->findAll(),
            'comentario' => $comentarioRepository->findAll(),

            
        ]);
    }
     /**
     * @Route("/page/admin/comentAdmin", name="comentAdmin")
     */
    public function comentAdmin(ComentarioRepository $comentarioRepository, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        return $this->render('adminPage/comentAdmin.html.twig', [
            'controller_name' => 'PageController',
            'comentarios' => $comentarioRepository->findAll(),
            ]);
    }


    /**
     * @Route("/page/admin/mensajes", name="mensajes")
     */
    public function mensajes(MensajeRepository $mensajeRepository, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        return $this->render('adminPage/mensajes.html.twig', [
            'controller_name' => 'PageAdminController',
            'mensajes' => $mensajeRepository->findAll(),

        ]);
    }
    /**
     * @Route("/page/admin/pedidos", name="pedidos")
     */
    public function pedidos(PedidosRepository $pedidosRepository, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        return $this->render('adminPage/pedidos.html.twig', [
            'controller_name' => 'PageAdminController',
            'pedidos' => $pedidosRepository->findAll(),
        ]);
    }
    /**
     * @Route("/page/admin/loginAdmin", name="loginAdmin")
     */
    public function loginAdmin(Request $request, SessionInterface $session)
    {
        
        $contactoBBDD=$this->getDoctrine()->getRepository(Usuario::Class)->findAll();
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Admin::class)
        ->findOneBy(['usuario' => $user]);
    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
        if ($user1) {
            return $this->redirectToRoute('page_admin');
        }
        else {
  if ($usuarioBBDD) {
    $passHash=password_hash( $usuarioBBDD->getPassword(), CRYPT_BLOWFISH);
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Admin::Class)
                  ->findOneBy(['usuario' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getUsuario());
                   return $this->redirectToRoute('page_admin');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
                    return $this->render('adminPage/loginAdmin.html.twig', [
                        'controller_name' => 'PageAdminController',
                        "user" => "",
                    "user" => $user1,
                    "mensaje" => $mensaje
                         ]);
                        }}

    /**
     * @Route("/page/admin/usuarios", name="usuarios")
     */
    public function usuarios(UsuarioRepository $usuarioRepository, Request $request, SessionInterface $session)
    {
        return $this->render('adminPage/usuariosAdmin.html.twig', [
            'controller_name' => 'PageAdminController',
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }
    /**
        * @Route("/page/admin/detalleUsuarios/{id}/{currentPage?1}", name="detalleUsuarios", methods={"GET","POST"})
     */
    public function detalleUsuarios($id, $currentPage, EntityManagerInterface $entityManager, Usuario $usuario, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $equiposFiltro=$this->getDoctrine()
        ->getRepository(Usuario::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
          $comentarioUsuario=$this->getDoctrine()
          ->getRepository(Comentario::Class)
          ->findBy(
              ['id_usuario' => $id], 
              ['id' => 'ASC']
            );
          $pedidoUsuario=$this->getDoctrine()
            ->getRepository(Pedidos::Class)
            ->findBy(
                ['id_cliente' => $id], 
                ['id' => 'ASC']
              );
        $form=$this->CreateForm(UsuarioType::Class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('detalleUsuarios', [
                "id" => $id,
               
       ]);
        }
        return $this->render('adminPage/detalleUsuario.html.twig', [
            'controller_name' => 'PageAdminController',
            'usuario' => $equiposFiltro,
            'comentarioUsuario' => $comentarioUsuario,
            'currentPage' => $currentPage,
            'data' => $comentarioUsuario,
            'id' => $id,
            'pedidoUsuario' => $pedidoUsuario,
            'form' => $form->CreateView(),
        ]);
    }


    
    /**
     * @Route("/page/admin/detallepedido/{id}", name="detallepedido", methods={"GET","POST"})
     */
    public function detallepedido($id, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $pedidoFiltro=$this->getDoctrine()
        ->getRepository(Pedidos::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
          $productosFiltro=$this->getDoctrine()
          ->getRepository(Productoxpedidos::Class)
          ->findBy(
              ['id_pedido' => $id], 
              ['id' => 'ASC']
            );
            foreach ($pedidoFiltro as $cliente) {
                $idcliente= $this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                    ['id' => $cliente->getIdCliente()], 
                    ['id' => 'ASC']
                  );
            }
        return $this->render('adminPage/invoice.html.twig', [
            'controller_name' => 'PageAdminController',
            'productos' => $productosFiltro,
            'idpedido'=> $id,
            'cliente' => $idcliente

        ]);
    }

    /**
     * @Route("/page/admin/newProducto", name="newProducto")
     */
    public function newProducto(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
    $producto = new Producto();
    $form = $this->createForm(ProductoType::class, $producto);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($producto);
        $producto->setUnidadesVendidas(0);
        $entityManager->flush();

        return $this->redirectToRoute('productosAdmin');
    }

        return $this->render('adminPage/newProducto.html.twig', [
           
            'form' => $form->createView(),
            'controller_name' => 'PageAdminController',


        ]);
    }
    
    /**
     * @Route("/page/admin/detalleProducto/{id}", name="detalleProducto", methods={"GET","POST"})
     */
    public function detalleProducto($id, Producto $producto, Request $request, SessionInterface $session): Response
    {
        $user1 = $session->get('nombre_usuario');
        $equiposFiltro=$this->getDoctrine()
        ->getRepository(Producto::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );

          $form = $this->createForm(ProductoType::class, $producto);
          $form->handleRequest($request);
  
      if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detalleProducto', array('id' => $id));
        }
          
        return $this->render('adminPage/detalleProducto.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
            'controller_name' => 'PageAdminController',
            'producto' => $equiposFiltro,

        ]);
    }
    /**
     * @Route("/page/admin/pdf/{id}", name="pdf", methods={"GET","POST"})
     */
    public function pdf(Request $request,$id, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $pedidoFiltro=$this->getDoctrine()
        ->getRepository(Pedidos::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
          $productosFiltro=$this->getDoctrine()
          ->getRepository(Productoxpedidos::Class)
          ->findBy(
              ['id_pedido' => $id], 
              ['id' => 'ASC']
            );
            foreach ($pedidoFiltro as $cliente) {
                $idcliente= $this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                    ['id' => $cliente->getIdCliente()], 
                    ['id' => 'ASC']
                  );
            }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('adminPage/factura.html.twig', [
            'title' => "Welcome to our PDF Test",
            'pedido' => $pedidoFiltro,
            'idpedido'=> $id,
            'productos' => $productosFiltro,
            'cliente' => $idcliente
        ]);

        $html = preg_replace("/>s+</", "><", $html);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        $f;
        if(headers_sent($f,$l)){
            echo $f,'<br>';
            die('se detecto linea');
        }
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF

        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }
    /**
     * @Route("/logOut", name="logOutAdmin")
     */
    public function logOut(Request $request, SessionInterface $session)
    {
        $session->clear();
        $session->invalidate();
                return $this->redirectToRoute('loginAdmin');

    }
}
