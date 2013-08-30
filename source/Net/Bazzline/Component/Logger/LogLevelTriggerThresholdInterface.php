<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class LogLevelTriggerThresholdInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
interface LogLevelTriggerThresholdInterface
{
    /**
     * @param array $logLevelToThresholdMap
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function __construct(array $logLevelToThresholdMap);

    /**
     * @param mixed $logLevel
     * @param mixed $logLevelTrigger
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function isThresholdReached($logLevel, $logLevelTrigger);
}