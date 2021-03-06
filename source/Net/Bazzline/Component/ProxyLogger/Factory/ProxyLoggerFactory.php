<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Net\Bazzline\Component\ProxyLogger\EventListener\ProxyEventListener;
use Net\Bazzline\Component\ProxyLogger\Logger\ProxyLogger;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-08
 * @todo implement setLogRequestFactory of BufferLoggerFactory?
 */
class ProxyLoggerFactory implements ProxyLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @return \Net\Bazzline\Component\ProxyLogger\Logger\ProxyLoggerInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-09
     */
    public function create(LoggerInterface $logger)
    {
        $proxyLogger = new ProxyLogger();

        $event = new ProxyEvent();
        $logRequestFactory = new LogRequestFactory();
        $dispatcher = new EventDispatcher();
        $listener = new ProxyEventListener();
        $listener->attach($dispatcher);

        $proxyLogger->addLogger($logger);
        $proxyLogger->setEvent($event);
        $proxyLogger->setEventDispatcher($dispatcher);
        $proxyLogger->setLogRequestFactory($logRequestFactory);

        return $proxyLogger;
    }
}