<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractFlushBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */
class AbstractFlushBufferTriggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    public function testIsValidLogLevelAwareInterface()
    {
        $factory = $this->getNewAbstractFlushBufferTriggerFactoryMock();

        $this->assertFalse($factory->hasIsValidLogLevel());
        $this->assertNull($factory->getIsValidLogLevel());

        $isValidLogLevel = $this->getNewIsValidLogLevelMock();

        $this->assertEquals($factory, $factory->setIsValidLogLevel($isValidLogLevel));
        $this->assertTrue($factory->hasIsValidLogLevel());
        $this->assertEquals($isValidLogLevel, $factory->getIsValidLogLevel());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    public function testSetInvalidLogLevelsToBypassWithoutIsValidLogLevel()
    {
        $factory = $this->getNewAbstractFlushBufferTriggerFactoryMock();

        $this->assertEquals($factory, $factory->setTriggerToLogLevel('Foo'));
    }

    /**
     * @expectedException \Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException
     * @expectedExceptionMessage invalid log level provided
     *
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    public function testSetInvalidLogLevelsToBypassWithIsValidLogLevel()
    {
        $factory = $this->getNewAbstractFlushBufferTriggerFactoryMock();
        $factory->setIsValidLogLevel($this->getNewIsValidLogLevel());
        $factory->setTriggerToLogLevel('Foo');
    }
}