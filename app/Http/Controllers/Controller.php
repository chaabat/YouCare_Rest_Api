<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="YouCare",
 *      version="1.0.0",
 *      description="L'API YouCare est une plateforme conçue pour faciliter le volontariat en mettant en relation les organisateurs d'événements avec des individus désireux de consacrer leur temps et leurs compétences. Grâce à cette API, les organisateurs peuvent créer facilement des annonces pour diverses initiatives, en spécifiant des détails tels que le type d'événement, la description, la date, le lieu et les compétences requises. Les volontaires peuvent parcourir ces annonces, les filtrer en fonction du type d'événement ou du lieu, et postuler pour participer à des projets correspondant à leurs intérêts et disponibilités.",
 *      @OA\Contact(
 *          email="chaabat.02@gmail.com"
 *      ),
 *      @OA\License(
 *          name="API License",
 *          url="http://www.example.com/license"
 *      ),
 * )
 * @OA\SecurityScheme(
 *      type="http",
 *      securityScheme="bearerAuth",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
