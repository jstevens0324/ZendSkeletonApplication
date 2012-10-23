<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Barcode\Barcode;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function barcodeAction()
    {
        // Only the text to draw is required
        $barcodeOptions = array('text' => 'ANDRITCHI-MIHAI');

        // No required options
        $rendererOptions = array();

        // Draw the barcode in a new image,
        // send the headers and the image
        Barcode::render('code39', 'image', $barcodeOptions, $rendererOptions);
    }
}
