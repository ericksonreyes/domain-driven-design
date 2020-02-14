<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Validation;

use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasComposition;

/**
 * Class ClassExtractor
 * @package EricksonReyes\DomainDrivenDesign\Common\Validation
 */
final class ClassExtractor
{
    /**
     * @param $aClassWithComposition
     * @param string $theClassNameBeingSearchedFor
     * @return mixed|null
     */
    public static function extract($aClassWithComposition, string $theClassNameBeingSearchedFor)
    {
        if ($aClassWithComposition instanceof $theClassNameBeingSearchedFor) {
            return $aClassWithComposition;
        }

        if ($aClassWithComposition instanceof HasComposition) {
            $aClassWithComposition = $aClassWithComposition->composition();
        }

        if (is_array($aClassWithComposition)) {
            foreach ($aClassWithComposition as $inheritedObject) {
                $searchResult = self::extract($inheritedObject, $theClassNameBeingSearchedFor);
                if ($searchResult !== null) {
                    return $searchResult;
                }
            }
        }

        if ($aClassWithComposition instanceof $theClassNameBeingSearchedFor) {
            return $aClassWithComposition;
        }

        return null;
    }

    /**
     * @param $aClassWithComposition
     * @param string $theClassNameBeingSearchedFor
     * @return bool
     */
    public static function contains($aClassWithComposition, string $theClassNameBeingSearchedFor): bool
    {
        if ($aClassWithComposition instanceof $theClassNameBeingSearchedFor) {
            return true;
        }

        if ($aClassWithComposition instanceof HasComposition) {
            $aClassWithComposition = $aClassWithComposition->composition();
        }

        if (is_array($aClassWithComposition)) {
            foreach ($aClassWithComposition as $inheritedObject) {
                $searchResult = self::contains($inheritedObject, $theClassNameBeingSearchedFor);
                if ($searchResult) {
                    return true;
                }
            }
        }

        return ($aClassWithComposition instanceof $theClassNameBeingSearchedFor);
    }
}
