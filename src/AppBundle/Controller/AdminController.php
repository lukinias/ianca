<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Curso;
use AppBundle\Form\CursoType;
use AppBundle\Form\PublicacionType;
use AppBundle\Entity\Publicacion;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/admin.html.twig', array(
            'active_menu' => '1'
        ));
    }

    /**
     * @Route("/listado-cursos", name="listado-cursos")
     */
    public function listadoCursosAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $cursoRepository = $this->getDoctrine()->getRepository(Curso::class);
        $cursos = $cursoRepository->findBy(array(), array('nombre' => 'ASC'));

        return $this->render('admin/listado-cursos.html.twig', array(
            'active_menu' => '1',
            'cursosArray' => $cursos
        ));
    }

    /**
     * @Route("/editar-curso/{id}", name="editar-curso")
     */
    public function editarCursoAction(Request $request, $id=null)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $curso = new Curso();

        if ( $id != null ) {
            $cursoRepository = $this->getDoctrine()->getRepository(Curso::class);
            $curso = $cursoRepository->find($id);
        }

        $formulario = $this->createForm(CursoType::class , $curso);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $curso = $formulario->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($curso);
            $em->flush();

            $this->addFlash('success', 'El curso se ha guardado correctamente.');

            //return $this->redirectToRoute('listado-cursos');
        }

        return $this->render('admin/editar-curso.html.twig', array(
            'active_menu' => '1',
            'formulario'    => $formulario->createView()
        ));
    }

    /**
     * @Route("/listado-publicaciones", name="listado-publicaciones")
     */
    public function listadoPublicacionesAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $publicacionRepository = $this->getDoctrine()->getRepository(Publicacion::class);
        $publicaciones = $publicacionRepository->findBy(array(), array('obra' => 'ASC'));

        return $this->render('admin/listado-publicaciones.html.twig', array(
            'active_menu' => '1',
            'publicacionesArray' => $publicaciones
        ));
    }

    /**
     * @Route("/editar-publicacion/{id}", name="editar-publicacion")
     */
    public function editarPublicacionAction(Request $request, $id=null)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $publicacion = new Publicacion();

        if ( $id != null ) {
            $publicacionRepository = $this->getDoctrine()->getRepository(Publicacion::class);
            $publicacion = $publicacionRepository->find($id);
        }

        $formulario = $this->createForm(PublicacionType::class , $publicacion);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            /** @var UploadedFile $imagenFile */
            $imagenFile = $formulario->get('imagen')->getData();

            if ($imagenFile) {
                $originalFilename = pathinfo($imagenFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = uniqid().'.'.$imagenFile->guessExtension();

                // Move the file to the directory where imagen are stored
                try {
                    $imagenFile->move(
                        $this->getParameter('publicaciones_imagenes_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Hubo un problema al cargar el archivo.');
                }

                $publicacion->setImagen($newFilename);
            }

            $publicacion = $formulario->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($publicacion);
                $em->flush();
            } catch (FileException $e) {
                $this->addFlash('error', 'Hubo un problema al guardar la capacitación.');
            }

            $this->addFlash('success', 'La publicación se ha guardado correctamente.');

            //return $this->redirectToRoute('listado-publicaciones');
        }

        return $this->render('admin/editar-publicacion.html.twig', array(
            'active_menu'   => '1',
            'formulario'    => $formulario->createView(),
            'imagen_nombre' => $publicacion->getImagen()
        ));
    }
}
