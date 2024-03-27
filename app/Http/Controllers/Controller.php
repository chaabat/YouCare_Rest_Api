<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="YouCare",
 *      version="1.0.0",
 *      description="YouCare API is a platform designed to facilitate volunteerism by connecting organizers of events with individuals willing to contribute their time and skills. Through this API, organizers can create announcements for various initiatives, specifying details such as event type, description, date, location, and required skills. Volunteers can browse these announcements, filtering them based on event type or location, and apply to participate in projects aligning with their interests and availability. The API also supports authentication mechanisms, allowing secure access to routes requiring authentication. Additionally, organizers have the ability to rate volunteers after each event, providing feedback to the community. Administrators can manage organizers, announcements, and volunteers, as well as view statistics related to events, organizers, and volunteers. With comprehensive documentation provided through Swagger, utilizing the YouCare API is made straightforward and accessible.",
 *      @OA\Contact(
 *          email="test@test.com"
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
