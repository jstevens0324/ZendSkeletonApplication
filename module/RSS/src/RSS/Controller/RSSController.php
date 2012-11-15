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
use RSS\Form\RSSComment;
use RSS\Form\RSSCommentFilter;

class RSSController extends AbstractActionController
{
    private $reader;
    public function indexAction()
    {
        $cache = \Zend\Cache\StorageFactory::adapterFactory('Memory');

        \Zend\Feed\Reader\Reader::setCache($cache);
        \Zend\Feed\Reader\Reader::useHttpConditionalGet();
        $this->reader = new Reader();
        try {
            $slashdotRss = \Zend\Feed\Reader\Reader::import('http://www.planet-php.net/rdf/');
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
            'author'      => $slashdotRss->getAuthor(),
            'items'       => array()
            );

        // Loop over each channel item/entry and store relevant data for each
        foreach ($slashdotRss as $item) {
            $channel['items'][] = array(
                'title'       => $item->getTitle(),
                'link'        => $item->getLink(),
                'description' => $item->getDescription(),
                'author'      => $item->getAuthor(),
                );
        }

        return array('channel' => $channel);
    }

    public function importFeedAction()
    {
        $feeds = new Reader();
        $links = $this->feedLinksAction();
        $feed = $feeds->import($links->rdf);
        $data = array(
            'title'         => $feed->getTitle(),
            'link'          => $feed->getLink(),
            'dateModified'  => $feed->getDateModified(),
            'description'  => $feed->getDescription(),
            'language'     => $feed->getLanguage(),
            'entries'      => array(),
        );

        foreach ($feed as $entry) {
            $edata = array(
                'title'        => $entry->getTitle(),
                'description'  => $entry->getDescription(),
                'dateModified' => $entry->getDateModified(),
                'authors'      => $entry->getAuthors(),
                'link'         => $entry->getLink(),
                'content'      => $entry->getContent()
            );
            $data['entries'][] = $edata;
        }

        return array('data' => $data);
    }

    private function feedLinksAction()
    {
        $links = \Zend\Feed\Reader\Reader::findFeedLinks('http://www.planet-php.net');

        return $links;
    }

    public function writeFeedAction()
    {
        $feed = new \Zend\Feed\Writer\Feed;
        $feed->setTitle('Paddy\'s Blog');
        $feed->setLink('http://www.example.com');
        $feed->setFeedLink('http://www.example.com/atom', 'atom');
        $feed->addAuthor(array(
            'name'  => 'Paddy',
            'email' => 'paddy@example.com',
            'uri'   => 'http://www.example.com',
        ));
        $feed->setDateModified(time());
        $feed->addHub('http://pubsubhubbub.appspot.com/');

        /**
         * Add one or more entries. Note that entries must
         * be manually added once created.
         */
        $entry = $feed->createEntry();
        $entry->setTitle('All Your Base Are Belong To Us');
        $entry->setLink('http://www.example.com/all-your-base-are-belong-to-us');
        $entry->addAuthor(array(
            'name'  => 'Paddy',
            'email' => 'paddy@example.com',
            'uri'   => 'http://www.example.com',
        ));
        $entry->setDateModified(time());
        $entry->setDateCreated(time());
        $entry->setDescription('Exposing the difficultly of porting games to English.');
        $entry->setContent(
            'I am not writing the article. The example is long enough as is ;).'
        );
        $feed->addEntry($entry);

        /**
         * Render the resulting feed to Atom 1.0 and assign to $out.
         * You can substitute "atom" with "rss" to generate an RSS 2.0 feed.
         */
        $out = $feed->export('atom');
    }

    public function addFeedComment()
    {
        $form = new RSSComment();
        $form->get('submit')->setValue('Add');

    }

}
