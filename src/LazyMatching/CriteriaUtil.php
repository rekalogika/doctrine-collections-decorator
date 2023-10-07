<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/doctrine-collections-decorator package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Collections\Decorator\LazyMatching;

use Doctrine\Common\Collections\Criteria;

use function DeepCopy\deep_copy;

final class CriteriaUtil
{
    private function __construct()
    {
    }

    public static function mergeCriteria(Criteria $criteria1, Criteria $criteria2): Criteria
    {
        /** @var Criteria */
        $criteria = deep_copy($criteria1);

        if ($criteria2->getFirstResult() !== null) {
            $criteria->setFirstResult($criteria2->getFirstResult());
        }

        if ($criteria2->getMaxResults() !== null) {
            $criteria->setMaxResults($criteria2->getMaxResults());
        }

        $where = $criteria2->getWhereExpression();
        if ($where !== null) {
            $criteria->andWhere($where);
        }

        $criteria->orderBy([
            ...$criteria->getOrderings(),
            ...$criteria2->getOrderings(),
        ]);

        return $criteria;
    }
}
