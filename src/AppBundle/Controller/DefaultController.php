<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * action de controleur qui, pour l'url"/", exécute la méthode indexAction,
     * qui retourne une vue twig, compilée en html grâce à la méthode render
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Création d'une route "dump", qui éxécute la méthode presentationAction, qui retourne
     * un texte, avec une fonction die qui nous permet de retourner une vue brute
     * @Route("/dump", name="dump")
     */
    public function presentationAction()
    {
// Un vardump suivi d'un édieé car oes action d'une classe controler (ex: presentationAction() )
// attendent une reponse HTTP
        var_dump("ceci est une pres");
        die;
    }


    /**
     * La Class "Response" (du composant HttpFoundation)
     * permet de renvoyer une reponse avec du texte HTML
     *
     * @Route("/response", name="response")
     */
    public function responseAction()
    {

        return new Response('
            <html>
              <body> 
                    <h1 style="text-align: center"> Mon titre </h1> 
                    <p style="text-align: center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci alias assumenda cupiditate, dolores exercitationem
                     facilis iusto minima modi nemo, nesciunt nostrum perferendis porro, quisquam sed sunt velit? Ab, blanditiis?</p>
               </body>
            </html>'
        );
    }
    /**
     * @Route("/redirection", name="redirection")
     */
// La méthode "redirectToRoute" permet de renvoyer vers une @route en interne
//Hors la méthode "redirect" permet de renvoyer vers une URL exterieur
    public function redirectionAction()
    {
        return $this->redirectToRoute("response");
    }

    /**
     * @Route("/redirectionExt", name="redirectionExt")
     */
    public function googleAction()
    {
        return $this->redirect("http://google.fr");
    }

    /**
     * @Route("/request_query_parameterAge", name="request_query_parameterAge")
     */

    public function requestQueryParameterAgeAction()
    {
        $request = Request::createFromGlobals();
        $age = $request->query->get('age');

        if ($age >= 18) {
            return new Response("T'es vieux");
        } else {
            return new Response("Tu es jeune");
        }
// deuxième façon de recuperer le request:
// public function requestQueryParameterAgeAction(Request $request)
// { return new Response($request->query->get('age'));
// if (age >= 18) { etc .....
    }

    /**
     * @Route("/request_query_parameter", name="request_query_parameter")
     */
    public function requestQueryParameterAction()
    {
        $request = Request::createFromGlobals();
        var_dump($request->query->get('age'));
        die;
    }

    /**
     * @Route("/moi/{page}", name="Moi")
     */

    public function requestQueryParameterMoiAction($page){
        $titre1 =" Mon super article de blog";
        $titre2="Qu'estce qu'un bottin";

        $contenu1 =" un super article";
        $contenu2 ="et footix tu sais l'écrire";

        if (intval($page) === 1){
            return new Response($titre1.':'.$contenu1);
        } elseif (intval($page) === 2){
            return new Response($titre2.':'.$contenu2);
        }
    }
    /**
    // * @Route("/twig", name="twig")
     */
    //public function twigAction()
   // {
    //    return $this->render("default/twig_veginner.html.twig");
   // }

    /**
     * @Route("/twiger/{age}", name="twiger")
     */
    public function TwigerAction($age){
        if($age >= 18){
            return $this->render("default/twiger.html.twig");
        } else {
            return $this->render("default/twig_veginner.html.twig");
        }
    }

    /**
     * @Route ("/twigPage/{age}", name="twigPage")
     */

    public function twigPageAction($age){
        return $this->render("default/twig-exo/twig_veginner.html.twig",
        [
            'age' => $age
        ]);
    }
}
