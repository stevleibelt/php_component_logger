<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\Factory\TriggerBufferLoggerFactory;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class TriggerBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 * @todo extend
 */
class TriggerBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreate()
    {
        $factory = new TriggerBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $buffer = $factory->create($logger, LogLevel::ERROR);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\TriggerBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\TriggerBufferLogger', $buffer);
        $this->assertTrue($buffer->getFlushBufferTrigger()->hasTrigger());
        $this->assertEquals(LogLevel::ERROR, $buffer->getFlushBufferTrigger()->getTrigger());
    }
}