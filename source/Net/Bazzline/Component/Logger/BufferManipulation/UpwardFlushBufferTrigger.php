<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 9/2/13
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Class UpwardFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class UpwardFlushBufferTrigger extends AbstractFlushBufferTrigger
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    protected $triggerAndUpwardLogLevelMap;

    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct(array $logLevelsToPass = array())
    {
        $this->triggerAndUpwardLogLevelMap = array(
            LogLevel::DEBUG => array(
                LogLevel::INFO => true,
                LogLevel::NOTICE => true,
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::INFO => array(
                LogLevel::NOTICE => true,
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::NOTICE => array(
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::WARNING => array(
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::ERROR => array(
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::CRITICAL => array(
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::ALERT => array(
                LogLevel::EMERGENCY => true
            )
        );
    }

    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        // TODO: Implement triggerBufferFlush() method.
    }
}