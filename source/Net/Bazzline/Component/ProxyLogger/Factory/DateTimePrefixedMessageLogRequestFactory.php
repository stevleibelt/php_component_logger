<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\DateTimePrefixedMessageLogRequest;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;

/**
 * Class DateTimePrefixedMessageLogRequestFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
class DateTimePrefixedMessageLogRequestFactory extends AbstractLogRequestFactory
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-21
     */
    protected function createNewLogRequestInstance($level, $message, array $context = array())
    {
        return new DateTimePrefixedMessageLogRequest($level, $message, $context);
    }
}
