<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Bridge\Doctrine\ArrayCollectionBridge;

/**
 * Class InputDataCollection
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input
 */
class InputDataCollection extends ArrayCollectionBridge implements InputDataCollectionInterface
{
}
