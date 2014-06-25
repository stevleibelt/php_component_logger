<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-06 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\UpwardFlushBufferTrigger;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class UpwardFlushBufferTriggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-06
 */
class UpwardFlushBufferTriggerTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no trigger' => array(
                'logLevel' => null,
                'logLevelToTrigger' => null,
                'expectedAvoidBuffering' => false
            ),
            'log level set but not trigger' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => null,
                'expectedTriggerBufferFlush' => false
            ),
            'log level set but different trigger' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToTrigger' => LogLevel::INFO,
                'expectedTriggerBufferFlush' => false
            ),
            'log level set and same to trigger' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => LogLevel::INFO,
                'expectedTriggerBufferFlush' => true
            ),
            'log level set and trigger level below' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => LogLevel::DEBUG,
                'expectedTriggerBufferFlush' => true
            ),
            'log level set and trigger level above' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => LogLevel::ALERT,
                'expectedTriggerBufferFlush' => false
            )
        );
    }

    /**
     * @dataProvider testCaseDataProvider
     *
     * @param mixed $logLevelToAdd
     * @param mixed $logLevelToTrigger
     * @param bool $expectedTriggerBufferFlush
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    public function testTriggerBufferFlush($logLevelToAdd, $logLevelToTrigger, $expectedTriggerBufferFlush)
    {
        $flushBufferTrigger = new UpwardFlushBufferTrigger();
        if (!is_null($logLevelToTrigger)) {
            $flushBufferTrigger->setTriggerTo($logLevelToTrigger);
        }

        $this->assertEquals($expectedTriggerBufferFlush, $flushBufferTrigger->triggerBufferFlush($logLevelToAdd));
    }
}