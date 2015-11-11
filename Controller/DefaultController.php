<?php

namespace Farmatholin\SegmentIoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SegmentIoBundle:Default:index.html.twig', array('name' => $name));
    }
}
