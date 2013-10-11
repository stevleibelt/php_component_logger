<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferAwareInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerAwareInterface;

/**
 * Class ManipulateBufferLoggerInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface ManipulateBufferLoggerInterface extends FlushBufferTriggerAwareInterface, BypassBufferAwareInterface, BufferLoggerInterface
{
}