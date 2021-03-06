<?php
/*
 * Copyright (c) 2013 Janos Szurovecz
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace predaddy\domain;

/**
 * Description of AggregateRootTest
 *
 * @author Janos Szurovecz <szjani@szjani.hu>
 */
class AggregateRootTest extends DomainTestCase
{
    public function testCallHandleMethod()
    {
        $user = new User();
        self::assertEquals(User::DEFAULT_VALUE, $user->value);

        $user->increment();
        $events = $this->getAndClearRaisedEvents();
        self::assertEquals(2, $user->value);
        self::assertTrue($events->valid());
        self::assertEquals($events->current()->aggregateId(), $user->getId());
    }

    public function testEquals()
    {
        $user = new User();
        $clone = $this->getMock(User::className(), ['getId'], [], '', false);
        $clone
            ->expects(self::once())
            ->method('getId')
            ->will(self::returnValue($user->getId()));
        self::assertTrue($user->equals($clone));
    }

    public function testToString()
    {
        $user = new User();
        self::assertStringStartsWith(User::className(), $user->toString());
    }

    /**
     * @test
     */
    public function stateHashMatching()
    {
        $user = new User();
        $events = $this->getAndClearRaisedEvents();
        self::assertCount(1, $events);
        $event = $events[0];
        /* @var $event DomainEvent */
        self::assertEquals($event->stateHash(), $user->stateHash());
        $user->failWhenStateHashViolation($event->stateHash());
    }

    /**
     * @test
     * @expectedException \precore\lang\IllegalStateException
     */
    public function stateHashViolationShouldThrowException()
    {
        $user = new User();
        $events = $this->getAndClearRaisedEvents();
        self::assertCount(1, $events);
        $event = $events[0];
        /* @var $event DomainEvent */
        self::assertEquals($event->stateHash(), $user->stateHash());

        $user->increment();
        $events = $this->getAndClearRaisedEvents();
        self::assertCount(1, $events);
        $event = $events[0];
        $user->failWhenStateHashViolation($event->stateHash());

        $user->failWhenStateHashViolation('invalid');
    }
}
