<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/9/12
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */

// module/RSS/src/RSS/Controller/RSSController.php
namespace RSS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Feed\Reader\Reader;
use Zend\View\Helper\HeadLink;

class RSSController extends AbstractActionController
{
    private $reader;
    public function indexAction()
    {
        $this->reader = new Reader();
        try {
            $slashdotRss =
                $this->reader->import('http://rss.slashdot.org/Slashdot/slashdot');
        } catch (Zend\Feed\Exception\Reader\RuntimeException $e) {
            // feed import failed
            echo "Exception caught importing feed: {$e->getMessage()}\n";
            exit;
        }

        // Initialize the channel/feed data array
        $channel = array(
            'title'       => $slashdotRss->getTitle(),
            'link'        => $slashdotRss->getLink(),
            'description' => $slashdotRss->getDescription(),
            'items'       => array()
            );

        // Loop over each channel item/entry and store relevant data for each
        foreach ($slashdotRss as $item) {
            $channel['items'][] = array(
                'title'       => $item->getTitle(),
                'link'        => $item->getLink(),
                'description' => $item->getDescription()
                );
        }

        return array('channel' => $channel);
    }
}
