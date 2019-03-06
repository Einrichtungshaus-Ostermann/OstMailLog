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

namespace OstMailLog\Models;

use Shopware\Components\Model\ModelRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Shopware\Components\Model\ModelManager;

class Repository extends ModelRepository
{



    /**
     * ...
     *
     * @param integer   $offset
     * @param integer   $limit
     * @param string    $search
     *
     * @return array
     */

    public function search( $offset = null, $limit = null, $search = "" )
    {
        /* @var $modelManager ModelManager */
        $modelManager = $this->getEntityManager();

        /* @var $builder QueryBuilder */
        $builder = $modelManager->createQueryBuilder();

        // build the query
        $builder->select( array( "mail.id" ) );
        $builder->from( Mail::class, "mail" );

        // do we have to search?
        if ( $search != "" )
            // add the search
            $builder->andWhere( "( mail.sender LIKE :search ) OR ( mail.recipient LIKE :search ) OR ( mail.subject LIKE :search ) OR ( mail.body LIKE :search )" )
                ->setParameter( "search", "%" . $search . "%" );

        // force default sorting
        $builder->orderBy( "mail.id", "DESC" );

        // set limits
        $builder->setFirstResult( $offset );
        $builder->setMaxResults( $limit );

        // get the query
        $query = $builder->getQuery();

        // as array
        $query->setHydrationMode( AbstractQuery::HYDRATE_ARRAY );

        // paginate the result
        $paginator = $modelManager->createPaginator($query);

        // ...
        return array(
            'total' => $paginator->count(),
            'mails' => $paginator->getIterator()->getArrayCopy(),
        );
    }



    /**
     * ...
     *
     * @param array   $ids
     *
     * @return array
     */

    public function getList( $ids )
    {
        // do we even have ids?
        if ( empty( $ids ) )
            // none found
            return array();

        // get the query builder
        $query = $this->getEntityManager()->createQueryBuilder();

        // build it
        $query->select( array( "mail" ) );
        $query->from( Mail::class, "mail" );
        $query->where( "mail.id IN (:ids)" );
        $query->setParameter( ":ids", $ids, Connection::PARAM_INT_ARRAY );

        // return result
        return $query->getQuery()->getArrayResult();
    }


}
