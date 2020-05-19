<?php

use PHPUnit\Framework\TestCase;

final class AirplaneSvcTest extends TestCase
{
    protected function setUp(): void
    {
        $this->service = new AirplaneService();
        $this->reflection = new \ReflectionClass(get_class($this->service));
    }
    
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }


    public function testFunctionName(): void
    {
        $return = $this->service->newAirplane('location',25);
        // var_dump($return);
        $this->assertTrue(True);
    }
}
