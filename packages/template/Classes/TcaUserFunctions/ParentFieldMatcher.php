<?php


namespace MIA3\Template\TcaUserFunctions;


use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Exception;

/**
 *
 * Checks if the value of the given field of the parent record, is the same as the given value.
 * Usage Example: In an TCA as 'displayCond'.
 * Usage: USER:MIA3\Template\TcaUserFunctions\ParentFieldMatcher->checkField:{field to check in parent}:{value to check}
 * NOTE: The second parameter can test for more than one value if the String is separated by ','!
 *
 * Class ParentFieldMatcher
 * @package MIA3\Template\TcaUserFunctions
 */
class ParentFieldMatcher
{

    /**
     * @param $args
     * @return bool
     * @throws MissingMandatoryParametersException
     * @throws Exception
     */
    public function checkField($args): bool
    {
        $parameters = $args['conditionParameters'];
        if ((!isset($parameters[0]) || !isset($parameters[1]))) {
            throw new MissingMandatoryParametersException(
                'Missing parameters! First parameter must be the "field_name" which should be checked! Second parameter must be the value to check!'
            );
        }
        $record = $args['record'];
        if (substr($record['uid'], 0, 3) === "NEW") {
            return true;
        }
        if ((!$record['parenttable'] || !$record['parentid'])) {
            throw new Exception('Parent was not found in this record!');
        }
        $parentRecord = BackendUtility::getRecord($record['parenttable'], $record['parentid']);
        if (!isset($parentRecord[$parameters[0]])) {
            throw new Exception("Given field '$parameters[0]' was not found in parent record!");
        }

        $checkParameter = explode(",", $parameters[1]);
        if (!is_array($checkParameter)) {
            return $parentRecord[$parameters[0]] === $checkParameter;
        }

        foreach ($checkParameter as $parameter) {
            if ($parentRecord[$parameters[0]] === $parameter) {
                return true;
            }
        }

        return false;
    }
}
