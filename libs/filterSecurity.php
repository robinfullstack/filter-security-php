<?php

/*
 * @FilterSecurity.php
 * @author    Robinson Pulgarin Torres <robinson-1010@hotmail.com>
 * @since     Martes, Febrero 25, 2020
 * Blacklist Keywords from GET - POST.
*/

class FilterSecurity
{
    private static $requestData;
    private static $requestMethod;
    private static $requestUrl;
    private static $requestProtocol;
    private static $requestHost;
    private static $requestModule;

    //Main folder. Example http://domain.com/blacklist
    const mainFolder = 'blacklist';

    /**
     * Keywords to filter by url.
     *
     * @return array
     */
    private function arrayWords()
    {
        $words = [
            '%3cscript',
            'alert(',
            '%3cbody',
            '%3chtml',
            'onload',
            '()%7b',
            '%3cobject',
            'javascript:',
            '("',
            'sql',
            'select',
            'function',
            'xss',
            '%2Fetc',
            'root',
            'query',
            'exec',
            'connect',
            'exists',
            'injection',
            'request',
            'server',
            'head',
            'join',
            '%3cstyle',
            '%3cdiv',
            'location',
            'content',
            'iframe',
            'src',
            'exec',
            'shell_access',
            'mysql',
            'mysqli_query',
            'db_connection',
            'update',
            'select',
            'delete'
        ];

        return $words;
    }
}