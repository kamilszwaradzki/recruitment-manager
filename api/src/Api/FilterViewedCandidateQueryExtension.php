<?php
namespace App\Api;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Candidate;
use Doctrine\ORM\QueryBuilder;

class FilterViewedCandidateQueryExtension implements QueryCollectionExtensionInterface
{
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $routeName = array_slice(preg_split("/[\/]+/", $context['request']->get('_route'), -1, PREG_SPLIT_NO_EMPTY), -1)[0];
        if (Candidate::class === $resourceClass && in_array($routeName, ['viewed_get_collection', 'fresh_get_collection'])) {
            $queryBuilder->andWhere(sprintf("%s.viewed = %s", $queryBuilder->getRootAliases()[0], json_encode($routeName === 'viewed_get_collection')));
        }
    }
}
