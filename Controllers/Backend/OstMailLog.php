<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Mail Log
 *
 * @package   OstMailLog
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2019 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

use OstMailLog\Models\Mail;
use OstMailLog\Models\Repository;

class Shopware_Controllers_Backend_OstMailLog extends Shopware_Controllers_Backend_ExtJs
{

    /**
     * ...
     *
     * @return array
     */
    public function getWhitelistedCSRFActions()
    {
        // return all actions
        return array_values(array_filter(
            array_map(
                function ($method) { return (substr($method, -6) === 'Action') ? substr($method, 0, -6) : null; },
                get_class_methods($this)
            ),
            function ($method) { return  !in_array((string) $method, ['', 'index', 'load', 'extends'], true); }
        ));
    }

    /**
     * ...
     *
     * @throws Exception
     */
    public function preDispatch()
    {
        // ...
        $viewDir = $this->container->getParameter('ost_mail_log.view_dir');
        $this->get('template')->addTemplateDir($viewDir);
        parent::preDispatch();
    }

    /**
     * ...
     *
     * @return void
     */

    public function getMailsAction()
    {
        // assign view
        $this->View()->assign(
            $this->getMails(
                $this->Request()->getParam( "search", "" ),
                $this->Request()->getParam( "start", 0 ),
                $this->Request()->getParam( "limit", 25 )
            )
        );
    }



    /**
     * ...
     *
     * @param string    $search
     * @param integer   $offset
     * @param integer   $limit
     *
     * @return array
     */

    protected function getMails( $search, $offset, $limit )
    {
        /* @var $repo Repository */
        $repo = $this->getModelManager()->getRepository( Mail::class );

        // execute the search
        $searchResult = $repo->search( $offset, $limit, $search );

        // total items and found ids
        $total = $searchResult['total'];
        $ids   = array_column( $searchResult['mails'], "id" );

        // get mails
        $mails = $repo->getList( $ids );

        // and return it
        return array(
            'success' => true,
            'total'   => $total,
            'data'    => $mails
        );
    }

}
