<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LogLevel;

/**
 * Class ProxyLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TriggeredBufferLogger extends BufferedLogger implements TriggeredBufferLoggerInterface
{
    /**
     * @var mixed
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $triggerLevel;

    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $triggerLevels;

    /**
     * @var @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $triggeredLogLevelInheritanceMap;

    /**
     * @author sleibelt
     * @since 2013-08-26
     */
    public function __construct()
    {
        $this->triggeredLogLevelInheritanceMap = array();
        $this->buildTriggerLevels();
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->logEntryBuffer->attach(
            $this->logEntryFactory->create($level, $message, $context)
        );

        if ($this->isTriggeredLogLevel($level)) {
            foreach ($this->logEntryBuffer as $logEntry) {
                /**
                 * @var LogEntry $logEntry
                 */
                $this->logger->log(
                    $logEntry->getLevel(),
                    $logEntry->getMessage(),
                    $logEntry->getContext()
                );
            }
        }
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelEmergency()
    {
        $this->setTriggerToLogLevel(LogLevel::EMERGENCY);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelAlert()
    {
        $this->setTriggerToLogLevel(LogLevel::ALERT);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelCritical()
    {
        $this->setTriggerToLogLevel(LogLevel::CRITICAL);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelError()
    {
        $this->setTriggerToLogLevel(LogLevel::ERROR);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelWarning()
    {
        $this->setTriggerToLogLevel(LogLevel::WARNING);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelNotice()
    {
        $this->setTriggerToLogLevel(LogLevel::NOTICE);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelInfo()
    {
        $this->setTriggerToLogLevel(LogLevel::INFO);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevelDebug()
    {
        $this->setTriggerToLogLevel(LogLevel::DEBUG);

        return $this;
    }

    /**
     * @param LogEntryFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectLogEntryFactory(LogEntryFactoryInterface $factory)
    {
        $this->logEntryFactory = $factory;

        return $this;
    }

    /**
     * @param mixed $level
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToLogLevel($level)
    {
        $this->triggerLevel = $level;
        $this->buildTriggerLevels();

        return $this;
    }

    /**
     * @param array $map
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggeredLogLevelInheritanceMap(array $map)
    {
        $this->triggeredLogLevelInheritanceMap = $map;
        $this->buildTriggerLevels();

        return $this;
    }

    /**
     * @return null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function getTriggerToLovLevel()
    {
        return $this->triggerLevel;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function buildTriggerLevels()
    {
        if (is_null($this->triggerLevel)) {
            $this->triggerLevels = array();
        } else {
            $this->triggerLevels = (isset($this->triggeredLogLevelInheritanceMap[$this->triggerLevel]))
                ? $this->triggeredLogLevelInheritanceMap[$this->triggerLevel] : array($this->triggerLevel);
            //we want to gain fast access
            $this->triggerLevels = array_flip($this->triggerLevels);
        }

        return $this;
    }

    /**
     * @param mixed $level
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function isTriggeredLogLevel($level)
    {
        return (($level == $this->triggerLevel)
                || (isset($this->triggerLevels[$level])));
    }
}