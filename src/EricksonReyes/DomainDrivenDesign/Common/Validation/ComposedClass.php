<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Validation;

/**
 * Class ComposedClass
 * @package EricksonReyes\DomainDrivenDesign\Common\Validation
 */
final class ComposedClass
{
    private $aComposedClass;

    /**
     * ComposedClass constructor.
     * @param $aClassWithComposition
     */
    public function __construct($aClassWithComposition)
    {
        $this->aComposedClass = $aClassWithComposition;
    }

    /**
     * @param string $theClassBeingSearched
     * @return bool
     */
    public function has(string $theClassBeingSearched): bool
    {
        return ClassExtractor::contains($this->composedClass(), $theClassBeingSearched);
    }

    /**
     * @param string $theClassBeingSearched
     * @return bool
     */
    public function doesntHave(string $theClassBeingSearched): bool
    {
        return !$this->has($theClassBeingSearched);
    }

    /**
     * @param string $theClassBeingSearchedFor
     * @return mixed|null
     */
    public function extract(string $theClassBeingSearchedFor)
    {
        return ClassExtractor::extract($this->composedClass(), $theClassBeingSearchedFor);
    }

    /**
     * @return mixed
     */
    private function composedClass()
    {
        return $this->aComposedClass;
    }
}
