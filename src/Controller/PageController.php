<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\{ProductoxpedidosRepository, CuentasBankRepository};
use App\Entity\{Mensaje,Comentario, Usuario, Producto, Productoxpedidos, Pedidos, Categoria, CuentasBank};
use Symfony\Component\HttpFoundation\Request;
use App\Form\{MensajeType, ComentarioType, UsuarioType, ProductoxpedidosType, PedidosType, ProductoxpedidoType, CuentasBankType};
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="index" )
     */
    public function index(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password=  $request->request->get("password");

        $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
        $categorias=$this->getDoctrine()
            ->getRepository(Categoria::class)
            ->findAll();
        $productos=$this->getDoctrine()
            ->getRepository(Producto::class)
            ->findBy(array(), array('unidades_vendidas' => 'ASC'));
        $productosStock=$this->getDoctrine()
            ->getRepository(Producto::class)
            ->findBy(array(), array('unidades_stock' => 'ASC'));         
        $puntuacion= $this->getDoctrine()
        ->getRepository(Comentario::class)
        ->findBy(array(), array('puntuacion' => 'ASC'));


       //Filtro Pedido      
    if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             
        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
              
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
                         
                                             

    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('index');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------
                   
            return $this->render('page/index.html.twig', [
                'controller_name' => 'PageController',
                'page' => 'index',
                'jumbotron' => 'no',
                "user" => $user1,
                "filtroPedido" => $idproducto,
                "mensaje" => $mensaje,
                "categorias" => $categorias,
                "productos" => $productos,
                "puntuacion" => $puntuacion,
                "stock" => $productosStock,
                "iduser" =>$idusario,

            ]);
        }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password=  $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        $comentarios=$this->getDoctrine()
        ->getRepository(Comentario::Class)
        ->findAll();
        $categorias= $this->getDoctrine()
        ->getRepository(Categoria::class)
        ->findAll();

        $Productos=$this->getDoctrine()
        ->getRepository(Producto::class)
        ->findAll();

        if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
          $userIniciado="";
          $mensaje="";
        if ($usuarioBBDD) {
          $passHash=$usuarioBBDD->getContrasenya();
          if (password_verify($password,  $passHash)) {
                    $usuarioIniciado=$this->getDoctrine()
                        ->getRepository(Usuario::Class)
                        ->findOneBy(['email' => $user], 
                                 ['id' => 'ASC']);
                         $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                         $userIniciado=$user1;
                         return $this->redirectToRoute('productos');}
                  else{
                    $mensaje="La contraseña o el email son incorrectos";
                        }
                      }
        return $this->render('page/productos.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'productos',
            'jumbotron' => 'si',
            'mensaje' => $mensaje,
            "user" => $user1,
            "filtroPedido" => $idproducto,
            "productos" => $Productos,
            "categorias" => $categorias,
            "Comentario" => $comentarios,
            "iduser" =>$idusario,
        ]);
      }

  /**
     * @Route("/producto/{id}", name="producto")
     */
    public function producto($id, Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password=  $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        $comentarios=$this->getDoctrine()
        ->getRepository(Comentario::Class)
        ->findAll();

        $Productos=$this->getDoctrine()
        ->getRepository(Producto::class)
        ->findBy(["categoria_id" => $id]);

        if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
          $userIniciado="";
          $mensaje="";
        if ($usuarioBBDD) {
          $passHash=$usuarioBBDD->getContrasenya();
          if (password_verify($password,  $passHash)) {
                    $usuarioIniciado=$this->getDoctrine()
                        ->getRepository(Usuario::Class)
                        ->findOneBy(['email' => $user], 
                                 ['id' => 'ASC']);
                         $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                         $userIniciado=$user1;
                         return $this->redirectToRoute('productos');}
                  else{
                    $mensaje="La contraseña o el email son incorrectos";
                        }
                      }
        return $this->render('page/todoProductos.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'productos',
            'jumbotron' => 'no',
            'mensaje' => $mensaje,
            "user" => $user1,
            "filtroPedido" => $idproducto,
            "productos" => $Productos,
            "Comentario" => $comentarios,
            "iduser" =>$idusario,

        ]);
      }
  

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password=  $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
            //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('servicios');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------

        return $this->render('page/servicios.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'servicios',
            'jumbotron' => 'si',
            "user" => $user1, 
            "filtroPedido" => $idproducto,
            "mensaje" => $mensaje,
            "iduser" =>$idusario,
            ]);
        }
    
    /**
     * @Route("/detalleprodc/{id}", name="detalleprod")
     */
    public function detalleprod(Request $request, $id, SessionInterface $session)
    {
        //Mantenemos la sesión del usuario
          $user1 = $session->get('nombre_usuario');

        //Filtramos los comentarios de cada producto
        $comentarios=$this->getDoctrine()
        ->getRepository(Comentario::Class)
        ->findBy(
              ['id_producto' => $id, ], 
              ['id' => 'ASC']
                );

        //Fin de filtro de los comentarios

        //Filtro Usuario  
if ($user1) {

          $usuarioIniciado=$this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                      ['nombre' => $user1], 
                      ['id' => 'ASC']
                        );
            
          $iduser=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['nombre' => $user1]);

          $idusuario= $iduser->getId();

          $idusario=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['id' => $idusuario]);
            
                
        //Acaba Filtro de usuario

        //Filtro Pedido 

          $pedidos=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findOneBy(['id_cliente' => $iduser->getId()]);
            
              
          $estado=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findOneBy(
                       ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                      }else {
                        $estado="";
                        $pedidos="";
                        $idusario="";

                      }
                     
      if ( $estado && $pedidos) {

          $idestado=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findBy(
                       ['id' => $estado->getId()]);
              
          $idpedidoEstado=$estado->getId();

          $idproducto=$this->getDoctrine()
                ->getRepository(Productoxpedidos::class)
                ->findBy(
                       ['id_pedido' => $idpedidoEstado]);

          $idproductoRepe=$this->getDoctrine()
                ->getRepository(Productoxpedidos::class)
                ->findOneBy(
                              ['id_pedido' => $idpedidoEstado, "id_producto" => $id]);  
                  
          $filtroPedido=$this->getDoctrine()
                ->getRepository(Pedidos::Class)
                ->findBy(
                       ['id' => $idpedidoEstado], 
                       ['id' => 'ASC']
                      );}
                
          else{$idproducto="";
            $idproductoRepe="";}
        
        //Filtro producto 

          $filtroProducto=$this->getDoctrine()
                ->getRepository(Producto::Class)
                ->findBy(
                       ['id' => $id], 
                       ['id' => 'ASC']
                      );

          $PedidoCreadoAhora="";

        //Acaba Filtro de producto

       //Envio de datos a la tabla productoxpedidos si hay un pedido incompleto

          $contactoTopedido=new Productoxpedidos();
          $actualizaCantidad=new Productoxpedidos();
          $formpedido=$this->CreateForm(ProductoxpedidoType::Class, $contactoTopedido);
          $formpedido->handleRequest($request);
          $formcantidad=$this->CreateForm(ProductoxpedidoType::Class, $actualizaCantidad);
          $formcantidad->handleRequest($request);
            
      if ($pedidos  && $estado) {

        if ($idusario->getId() == $pedidos->getIdCliente()->getId() && $estado){

            if($formpedido->isSubmitted() && $formpedido->isValid()){
                echo("Pedido ya existe por lo que hemos creado solo el producto");
                  $entityManager1=$this->getDoctrine()->getManager();
                    
                  foreach ($filtroProducto as $productoid) {
                     $contactoTopedido->setIdProducto($productoid);
                  }

                  foreach ($idestado as $pedidoid) {
                     $contactoTopedido->setIdPedido($pedidoid);
                  }
                  // && $mierda->getIdPedido()->getId() != $estado-getId()

                if ($idproductoRepe) {
                
                  if ($idproductoRepe->getIdProducto()->getId() != $id) {
                    $entityManager1->persist($contactoTopedido);
                    $entityManager1->flush(); 
                    return $this->redirectToRoute('detalleprod', [
                      "id" => $id,
                     
             ]);

                  }  
                  else{ 
                    foreach ($filtroProducto as $productoid) {
                      $actualizaCantidad->setIdProducto($productoid);
                   }
 
                   foreach ($idestado as $pedidoid) {
                      $actualizaCantidad->setIdPedido($pedidoid);
                   }  
                   $actualizaCantidad->setCantidad($actualizaCantidad->getCantidad() + $idproductoRepe->getCantidad());
                   $entityManager1->remove($idproductoRepe);
                    $entityManager1->persist($actualizaCantidad);
                  $entityManager1->flush();};
                  return $this->redirectToRoute('detalleprod', [
                    "id" => $id]);
            }
         
          else{

                    $entityManager1->persist($contactoTopedido);
                    $entityManager1->flush(); 
                    return $this->redirectToRoute('detalleprod', [
                      "id" => $id]);
          }
          } }
        }

        //Finaliza el envio de datos a la tabla productoxpedido

        //Creamos el pedido incompleto al pulsar el botón de añadir producto

                  else{
                    $contactoTopedidos=new Pedidos();
                    $formpedidos=$this->CreateForm(PedidosType::Class, $contactoTopedidos);
                    $formpedidos->handleRequest($request);
                    if($formpedido->isSubmitted() && $formpedido->isValid()){
                      $entityManager1=$this->getDoctrine()->getManager();
                    $contactoTopedidos->setIdCliente($idusario);
                    $contactoTopedidos->setNombreCliente($iduser->getNombre());
                    $contactoTopedidos->setTelefono($iduser->getTelefono());
                    $contactoTopedidos->setProvincia($iduser->getProvincia());
                    $contactoTopedidos->setDireccion($iduser->getDireccion());
                    $contactoTopedidos->setFechaPedido(new \DateTime('now'));
                    $contactoTopedidos->setEstado("incompleto");
                    $pedidos=$this->getDoctrine()
                    ->getRepository(Pedidos::class)
                    ->findOneBy(['id_cliente' => $iduser->getId()]);
                    $PedidoCreadoAhora="true";
                    $entityManager1->persist($contactoTopedidos);
                    $entityManager1->flush();
                    // return $this->redirectToRoute('detalleprod', [
                    //   "id" => $id]);
                  }

        //Finaliza el crear el pedido

        //Creamos los productos del pedido creado ahora mismo
                }

                
            //     $cantidadActualizada= $idproductoRepe->getCantidad() + 2;    
            // echo($cantidadActualizada);
      
                if ($PedidoCreadoAhora) {
                $estado=$this->getDoctrine()
                  ->getRepository(Pedidos::class)
                  ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);

                $idestado=$this->getDoctrine()
                  ->getRepository(Pedidos::class)
                  ->findBy(['id' => $estado->getId()]);
                
                $idpedidoEstado=$estado->getId();

                $filtroPedido=$this->getDoctrine()
                ->getRepository(Pedidos::Class)
                ->findBy(
                    ['id' => $idpedidoEstado], 
                    ['id' => 'ASC']
                  ); 

                foreach ($filtroProducto as $productoid) {
                  $contactoTopedido->setIdProducto($productoid);
                }
                foreach ($idestado as $pedidoid) {
                  $contactoTopedido->setIdPedido($pedidoid);
                }

                $entityManager1->persist($contactoTopedido);
                $entityManager1->flush();
                return $this->redirectToRoute('detalleprod', [
                  "id" => $id,
                 
         ]);
        
       }

        //Finalizado crear productos en el pedido

        //Filtro del usuario

                // $filtroUsuario=$this->getDoctrine()
                // ->getRepository(Usuario::Class)
                // ->findBy(
                //     ['id' => "1"], 
                //     ['id' => 'ASC']
                //   );

        //Acaba filtro del usuario



         //Formulario Comentario   
        $contactoTo=new Comentario();
        $form=$this->CreateForm(ComentarioType::Class, $contactoTo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFecha(new \DateTime('now'));

                $contactoTo->setIdUsuario($iduser);
           
              foreach ($filtroProducto as $productoid) {
                $contactoTo->setIdProducto($productoid);
              }
            $entityManager->persist($contactoTo);
            $entityManager->flush();
            return $this->redirectToRoute('detalleprod', [
              "id" => $id,
             
     ]);}
            //Acaba formulario del comentario

          //Inicio de sesión de usuario
            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
            $password=  $request->request->get("password");
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('detalleprod', [
                    "id" => $id,
           ]);
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------
        return $this->render('page/detalleProduct.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'detalle',
            'form' => $form->CreateView(),
            'form1' => $formpedido->CreateView(),
            'jumbotron' => 'no',
            "user" => $user1, 
            "producto" => $filtroProducto,
            "puntuacion1" => "3",
            "filtroPedido" => $idproducto,
            "Comentario" => $comentarios,
            "productostock" => $idproductoRepe,
            "filtroPedido" => $idproducto,  
            "mensaje" => $mensaje,
            "iduser" =>$idusario,

        ]);
            
    }
    
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(Request $request, SessionInterface $session)
    {
        
        $contactoBBDD=$this->getDoctrine()->getRepository(Mensaje::Class)->findAll();
        $contactoTo=new Mensaje();
        $form=$this->CreateForm(MensajeType::Class, $contactoTo);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFecha(new \DateTime('now'));
            $entityManager->persist($contactoTo);
            $entityManager->flush();}

            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
            $password=  $request->request->get("password");
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
            if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('contacto');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------
        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'contacto',
            'form' => $form->CreateView(),
            'jumbotron' => 'si',
            "user" => "",
            "user" => $user1, 
            "filtroPedido" => $idproducto,
            "mensaje" => $mensaje,
            "iduser" =>$idusario,
        ]);
    }
    /**
     * @Route("/carrito", name="carrito",  methods={"GET","POST"})
     */
    public function carrito(Request $request, SessionInterface $session,EntityManagerInterface $entityManager, ProductoxpedidosRepository $productoxpedidosRepository)
    {

      $test=array();
      $idpedidoprod= $request->request->get("idpedidoprod");


               $fil=$this->getDoctrine()
                ->getRepository(Productoxpedidos::Class)
                ->findAll(
                    ['id']
                  );
                  $XV = 0;
                    foreach ($fil as $key) {
                      $asas = $key->getId();
                      $XV = $XV + 1; 
                      array_push($test, $asas);
                    }
                    
              $form = $this->createForm(ProductoxpedidosType::class );
              $form->handleRequest($request);
              if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();}
                $mensajeRepe="";
                $limitTarjeta = "";
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $ultDigits= $request->request->get("UltDigits");
        $numTarje= $request->request->get("inputNumber1");
        $cvv= $request->request->get("inputCvv");
        $password=  $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);

        if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
            $BankTarj=$this->getDoctrine()
              ->getRepository(CuentasBank::Class)
              ->findBy(['id_cliente' => $idusario, "estado" => "activa"], 
              ['id' => 'ASC']);

              $tarjetaRepe=$this->getDoctrine()
              ->getRepository(CuentasBank::Class)
              ->findBy(['ultimos_digitos' => $ultDigits, "estado" => "activa", "id_cliente" => $idusuario ], 
              ['id' => 'ASC']);

                  foreach ( $tarjetaRepe as $repe) {
                    var_dump("hola");
                    if (password_verify($numTarje,  $repe->getNumTarjeta())) {

                        $mensajeRepe="Esta tarjeta ya está en uso";
                        $repetar="true";
                        
                  }      }   
                $contador=0;
                  foreach ($BankTarj as $nada) {
                     $contador=$contador+1;

                  }

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";
                              $BankTarj="";}
                              
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                        
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }

          $contactoTo=new CuentasBank();
          $formTarjeta=$this->CreateForm(CuentasBankType::Class, $contactoTo);

          if (!$mensajeRepe) {
          
          if ($contador <4 ) {
          $formTarjeta->handleRequest($request);

          $numTar=password_hash( $numTarje, CRYPT_BLOWFISH);
          $nCvv=password_hash( $cvv, CRYPT_BLOWFISH);

          

            if($formTarjeta->isSubmitted() && $formTarjeta->isValid()){
                $entityManager=$this->getDoctrine()->getManager();
                $contactoTo->setUltimosdigitos($ultDigits);
                $contactoTo->setNumtarjeta($numTar);
                $contactoTo->setCvv($nCvv);
                $contactoTo->setEstado("Activa");
                $contactoTo->setIdCliente($idusario);
                $entityManager->persist($contactoTo);
                $entityManager->flush();
                return $this->redirectToRoute('carrito');
              }
          } 
          else {
            $limitTarjeta="No puedes agregar más tarjetas";
          }}

    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('carrito');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------
        return $this->render('page/carrito.html.twig', [
            'controller_name' => 'PageController',
            'form' => $form->CreateView(),
            'formTarjeta' => $formTarjeta->CreateView(),
            'page' => 'carrito',
            'jumbotron' => 'no',
            "mensaje" => $mensaje,
            "user" => $user1,
            "filtroPedido" => $idproducto,
            "filtroTarjetas" => $BankTarj,
            'NumCols' => $XV,
            'test' => $test,
            "iduser" =>$idusario,
            "numT" => $numTarje,
            "mensajeLimite" => $limitTarjeta,
            "tarjetaRepe" => $mensajeRepe
        ]);

    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, SessionInterface $session)
    {
        $contactoBBDD=$this->getDoctrine()->getRepository(Usuario::Class)->findAll();
        $contactoTo=new Usuario();
        $form=$this->CreateForm(UsuarioType::Class, $contactoTo);
        $form->handleRequest($request);
        $password= $request->request->get("password");
        $passwordReg= $request->request->get("PasswordReg");
        $pass=password_hash( $passwordReg, CRYPT_BLOWFISH);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFechaRegistro(new \DateTime('now'));
            $contactoTo->setContrasenya($pass);
            $entityManager->persist($contactoTo);
            $entityManager->flush();}

            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
           
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
            if ($user1) {
            $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
                             

        $pedidos=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findOneBy(['id_cliente' => $iduser->getId()]);
                             
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";}
                                     
   if ( $estado && $pedidos) {
                   
        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(['id' => $estado->getId()]);
                               
        $idpedidoEstado=$estado->getId();
                   
        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(['id_pedido' => $idpedidoEstado]);
                    
                                   
        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(['id' => $idpedidoEstado], 
                       ['id' => 'ASC']);}
      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
          }
    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('login');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------

        return $this->render('page/registro.html.twig', [
            'page' => 'carrito',
            'jumbotron' => 'no',
            'form' => $form->CreateView(),
            "user" => "",
            "user" => $user1,
            "filtroPedido" => $idproducto,
            "mensaje" => $mensaje,
            "iduser" =>$idusario,

        ]);}

      /**
     * @Route("/perfil/{id}/{currentPage?1}", name="perfil" )
     */
    public function perfil($id, $currentPage,Request $request, SessionInterface $session, Usuario $usuario, CuentasBank $cuentasBank, EntityManagerInterface $entityManager)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password=  $request->request->get("password");

        $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
        $categorias=$this->getDoctrine()
            ->getRepository(Categoria::class)
            ->findAll();
        $pedido=$this->getDoctrine()
            ->getRepository(Pedidos::class)
            ->findAll();
        $puntuacion= $this->getDoctrine()
        ->getRepository(Comentario::class)
        ->findBy(array(), array('puntuacion' => 'ASC'));
        $creditBank= $this->getDoctrine()
        ->getRepository(CuentasBank::class)
        ->findBy(['id_cliente' => $id, "estado" => "activa"]); 

       //Filtro Pedido      
    if ($user1) {
        $iduser=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $idusuario]);
                                   
        $pedidos=$this->getDoctrine()
            ->getRepository(Pedidos::class)
            ->findOneBy(['id_cliente' => $iduser->getId()]);     
                           
        $pedidosCompleto=$this->getDoctrine()
             ->getRepository(Pedidos::class)
             ->findBy(['id_cliente' => $iduser->getId(), "estado" => "completo"]);
                               
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                      else {
                              $estado="";
                              $pedidos="";
                              $idusario="";
                              
                              }


                    if ( $estado && $pedidos) {
                                    
                          $idestado=$this->getDoctrine()
                                ->getRepository(Pedidos::class)
                                ->findBy(['id' => $estado->getId()]);
                                                
                          $idpedidoEstado=$estado->getId();

                          
                                    
                          $idproducto=$this->getDoctrine()
                                ->getRepository(Productoxpedidos::class)
                                ->findBy(['id_pedido' => $idpedidoEstado]);
                                
                                      
                                                    
                          $filtroPedido=$this->getDoctrine()
                                ->getRepository(Pedidos::Class)
                                ->findBy(['id' => $idpedidoEstado], 
                                        ['id' => 'ASC']);}



      else{
           $idproducto="";
           $idproductoRepe="";
           $filtroPedido="";
           
          }
                         
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
            $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['id' => $id], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
              $this->getDoctrine()->getManager()->flush();
              return $this->redirectToRoute('perfil', [
                  "id" => $id,
                 
         ]);                         }     
         
         $delete= $request->request->get("_method");
         $eliminarTarjeta= $request->request->get("_token");
                  
                  // $form = $this->createForm(CuentasBankType::class, $cuentasBank);
                  // $form->handleRequest($request);
         if ($delete && $eliminarTarjeta) {
          $filtroP=$this->getDoctrine()
          ->getRepository(CuentasBank::Class)
          ->findOneBy(["id" => $eliminarTarjeta]);
          $entityManager = $this->getDoctrine()->getManager();
          $filtroP->setEstado("eliminida");
          $entityManager->flush($filtroP);
          $entityManager->flush();
          return $this->redirectToRoute('perfil', [
            "id" => $id,
           
   ]);  

         }
         

    //Recoger contraseña encriptada y comprobar si el inicio de sesion es correcto                             
    $userIniciado="";
    $mensaje="";
  if ($usuarioBBDD) {
    $passHash=$usuarioBBDD->getContrasenya();
    if (password_verify($password,  $passHash)) {
              $usuarioIniciado=$this->getDoctrine()
                  ->getRepository(Usuario::Class)
                  ->findOneBy(['email' => $user], 
                           ['id' => 'ASC']);
                   $session->set('nombre_usuario', $usuarioIniciado->getNombre());
                   return $this->redirectToRoute('index');
                   }
            else{
              $mensaje="La contraseña o el email son incorrectos";
                  }
                }
    //--------------------------------------------------------------------------------
                   
            return $this->render('page/perfil.html.twig', [

                'controller_name' => 'PageController',
                'page' => 'perfil',
                'jumbotron' => 'no',
                "user" => $user1,
                "iduser" =>$idusario,
                "filtroPedido" => $idproducto,
                'filtroPedidoCompleto' => $pedidosCompleto,
                "mensaje" => $mensaje,
                "categorias" => $categorias,
                "puntuacion" => $puntuacion,
                'usuario' => $equiposFiltro,
                'comentarioUsuario' => $comentarioUsuario,
                'currentPage' => $currentPage,
                'data' => $comentarioUsuario,
                'id' => $id,
                'pedidoUsuario' => $pedidoUsuario,
                'form' => $form->CreateView(),
                'creditCard' => $creditBank,
                'pedidoUsuario' => $pedido,

            ]);
        }

    /**
     * @Route("/detallepedido/{id}", name="detallepedidouser", methods={"GET","POST"})
     */
    public function detallepedido(Request $request, $id, SessionInterface $session)
    {
      $user1 = $session->get('nombre_usuario');
      $user= $request->request->get("user");
      $password=  $request->request->get("password");

      $usuarioBBDD=$this->getDoctrine()
          ->getRepository(Usuario::class)
          ->findOneBy(['email' => $user]);
          if ($user1) {
            $iduser=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['nombre' => $user1]);
    
            $idusuario= $iduser->getId();
    
            $idusario=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['id' => $idusuario]);
                                       
            $pedidos=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findOneBy(['id_cliente' => $iduser->getId()]);     
                               
            $pedidosCompleto=$this->getDoctrine()
                 ->getRepository(Pedidos::class)
                 ->findBy(['id_cliente' => $iduser->getId(), "estado" => "completo"]);
                                   
            $estado=$this->getDoctrine()
                  ->getRepository(Pedidos::class)
                  ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);}
                          else {
                                  $estado="";
                                  $pedidos="";
                                  $idusario="";
                                  
                                  }
    
    
                        if ( $estado && $pedidos) {
                                        
                              $idestado=$this->getDoctrine()
                                    ->getRepository(Pedidos::class)
                                    ->findBy(['id' => $estado->getId()]);
                                                    
                              $idpedidoEstado=$estado->getId();
    
                              
                                        
                              $idproducto=$this->getDoctrine()
                                    ->getRepository(Productoxpedidos::class)
                                    ->findBy(['id_pedido' => $idpedidoEstado]);
                                    
                                          
                                                        
                              $filtroPedido=$this->getDoctrine()
                                    ->getRepository(Pedidos::Class)
                                    ->findBy(['id' => $idpedidoEstado], 
                                            ['id' => 'ASC']);}
    
    
    
          else{
               $idproducto="";
               $idproductoRepe="";
               $filtroPedido="";

              }
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
        return $this->render('page/verFactura.html.twig', [
            'controller_name' => 'PageAdminController',
            'page' => 'factura',
            'jumbotron' => 'no',
            'productos' => $productosFiltro,
            'idpedido'=> $id,
            'cliente' => $idcliente,
            "user" => "",
            "user" => $user1,
            "iduser" =>$idusario,
            "filtroPedido" => $idproducto,
        ]);
    }

    /**
     * @Route("/logOut", name="logOut")
     */
    public function logOut(Request $request, SessionInterface $session)
    {
        $session->clear();
        $session->invalidate();
                return $this->redirectToRoute('index');

    }
}
