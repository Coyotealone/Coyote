<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\SiteBundle\Form\UserType;
use Coyote\SiteBundle\Form\TimeType;
use Coyote\SiteBundle\Form\ScheduleType;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;

use Doctrine\ORM\EntityRepository;

/**
 * Main controller.
 *
 */
class TimeController extends Controller
{

}

