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

    public function requestQueryParameterMoiAction($page)
    {
        $titre1 = " Mon super article de blog";
        $titre2 = "Qu'estce qu'un bottin";

        $contenu1 = " un super article";
        $contenu2 = "et footix tu sais l'écrire";

        if (intval($page) === 1) {
            return new Response($titre1 . ':' . $contenu1);
        } elseif (intval($page) === 2) {
            return new Response($titre2 . ':' . $contenu2);
        }
    }
    /**
     * // * @Route("/twig", name="twig")
     */
    //public function twigAction()
    // {
    //    return $this->render("default/twig.html.twig");
    // }

    /**
     * @Route("/twiger/{age}", name="twiger")
     */
    public function TwigerAction($age)
    {
        if ($age >= 18) {
            return $this->render("default/twiger.html.twig");
        } else {
            return $this->render("default/twig.html.twig");
        }
    }

    /**
     * @Route ("/twigPage/{age}", name="twigPage")
     */

    public function twigPageAction($age)
    {
        $articles = ['article 1', 'article 2', 'article 3'];
        return $this->render("default/twig-exo/twig.html.twig",
            [
                'age' => $age,
                'Articles' => $articles
            ]);
    }

    /**
     * @Route ("/twig_page_2", name="twigPage2")
     */
    public function twig2PageAction()
    {
        $articles = [
            [
                'title' => 'titre de mon article 1',
                'content' => 'contenu de mon article 1',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'title' => 'titre de mon article 2',
                'content' => 'contenu de mon article 2',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'title' => 'titre de mon article 3',
                'content' => 'contenu de mon article 3',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'title' => 'titre de mon article 4',
                'content' => 'contenu de mon article 4',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ]
        ];

        return $this->render("default/twig-exo/twig2.html.twig",
            [
                'articles' => $articles
            ]
        );
    }
    /**
     * @Route ("twig_article", name="twig_article")
     */

    public function twigBouclesArticleAction(){
        $articles = [
            [
                'id' => 1,
                'title' => 'titre de mon article 1',
                'content' => 'contenu de mon article 1',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 2,
                'title' => 'titre de mon article 2',
                'content' => 'contenu de mon article 2',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 3,
                'title' => 'titre de mon article 3',
                'content' => 'contenu de mon article 3',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 4,
                'title' => 'titre de mon article 4',
                'content' => 'contenu de mon article 4',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 5,
                'title' => 'titre de mon article 5',
                'content' => 'contenu de mon article 5',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 6,
                'title' => 'titre de mon article 6',
                'content' => 'contenu de mon article 6',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ]
        ];



        return $this->render("default/twig-exo/twig_boucles.html.twig",
            [
                'article' => $articles,
            ]
        );

    }
        /**
         * @Route ("/twig_single_article/{id}", name="twig_single_article")
         */
        public function twigSingleArticleAction($id){
            $articles = [
                [
                    'id' => 1,
                    'title' => 'titre de mon article 1',
                    'content' => 'contenu de mon article 1',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 2,
                    'title' => 'titre de mon article 2',
                    'content' => 'contenu de mon article 2',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 3,
                    'title' => 'titre de mon article 3',
                    'content' => 'contenu de mon article 3',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 4,
                    'title' => 'titre de mon article 4',
                    'content' => 'contenu de mon article 4',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 5,
                    'title' => 'titre de mon article 5',
                    'content' => 'contenu de mon article 5',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 6,
                    'title' => 'titre de mon article 6',
                    'content' => 'contenu de mon article 6',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ]
            ];

            $article =  $articles[$id-1];

            return $this->render("default/twig-exo/twig_single_article.html.twig",
                [
                    'element' => $article,
                    'article' => $articles

                ]
            );

        }
        /**
         * @Route ("/json", name = "json")
         */

        public function jsonAction(){
            // Je vais récupeer un fichier json, sur les serveurs de github
            $json= file_get_contents('https://raw.githubusercontent.com/LearnWebCode/json-example/master/pets-data.json');
            // comme je ne peux pas exploiter directement le json en PHP
            // j'utilise la fonction nativde de php json_decode
            // pour convertir le json en objet / array php
            $jsonDecoded = json_decode($json);

            // j'appelle un fichier twig et je lui passe un paramètre "jsonDecoded" qui contient notre json decodé en PHP
                return $this->render('default/twig-exo/json.html.twig',
                    [
                        'jsonDecoded' => $jsonDecoded
                    ]
                );
        }

    /**
     * @Route ("json/{id}", name="json_id")
     */

    public function jsonSingleAction($id){
        $json = file_get_contents('https://raw.githubusercontent.com/LearnWebCode/json-example/master/pets-data.json');
        $jsonDecoded = json_decode($json);
        $goodId=$id-1;
        $article=$jsonDecoded->pets[$goodId];

        return $this->render("default/twig-exo/json_detail.html.twig",
            [
                'index' => $goodId,
                'article' => $article
            ]
            );

    }

























        /**
         * @Route("/twig_exo" , name ="twig_exo")
         */
        public function twigExoAction(){
            $listes = [
                [
                    'id' => 1,
                    'title' => 'titre de mon article 1',
                    'content' => 'contenu de mon article 1',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 2,
                    'title' => 'titre de mon article 2',
                    'content' => 'contenu de mon article 2',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ],
                [
                    'id' => 3,
                    'title' => 'titre de mon article 3',
                    'content' => 'contenu de mon article 3',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                    ],
                [
                    'id' => 4,
                    'title' => 'titre de mon article 4',
                    'content' => 'contenu de mon article 4',
                    'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
                ]
                ];

            return $this->render('default/twig-exo/base.html.twig',
            [
                'listes' => $listes
            ]
            );
        }

        /**
         * @Route("/twig_single_exo/{id}", name="twig_single_exo")
         */
    public function twigExoSingleAction($id){
        $listes = [
            [
                'id' => 1,
                'title' => 'titre de mon article 1',
                'content' => 'contenu de mon article 1',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 2,
                'title' => 'titre de mon article 2',
                'content' => 'contenu de mon article 2',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 3,
                'title' => 'titre de mon article 3',
                'content' => 'contenu de mon article 3',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ],
            [
                'id' => 4,
                'title' => 'titre de mon article 4',
                'content' => 'contenu de mon article 4',
                'img' => 'https://www.ginjfo.com/wp-content/uploads/2015/02/LinuxVsWindows.jpg'
            ]
        ];

        $liste = $listes[$id-1];
        return $this->render('default/twig-exo/exercice_single.html.twig',
            [
                'liste' => $liste,
                'listes' => $listes
            ]);

    }
}
