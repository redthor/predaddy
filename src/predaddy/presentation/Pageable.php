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

namespace predaddy\presentation;

use precore\lang\ObjectInterface;

/**
 * Useful for pagination to be able to define paging and sorting informations.
 *
 * @author Janos Szurovecz <szjani@szjani.hu>
 */
interface Pageable extends ObjectInterface
{
    /**
     * @return int
     */
    public function getPageNumber();

    /**
     * @return int
     */
    public function getPageSize();

    /**
     * @return int
     */
    public function getOffset();

    /**
     * @return Sort
     */
    public function getSort();

    /**
     * @return Pageable
     */
    public function next();

    /**
     * @return Pageable
     */
    public function previousOrFirst();

    /**
     * @return Pageable
     */
    public function first();

    /**
     * @return boolean
     */
    public function hasPrevious();
}
