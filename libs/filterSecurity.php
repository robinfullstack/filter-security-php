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

    /**
     * Convert array request to string.
     *
     * @return string
     */
    private function convertString($arrayRequest)
    {
        $convertString = json_encode($arrayRequest);

        //Make a string lowercase.
        $convertLower = strtolower($convertString);

        //Skip spaces in string.
        $ValidateString = str_replace(' ', '', $convertLower);

        return $ValidateString;
    }

    /**
     * Get current url.
     *
     * @return url
     */
    private function getUrl()
    {
        if (isset($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] == 'on')
            self::$requestProtocol = 'https://';
        else
            self::$requestProtocol = 'http://';

        self::$requestHost = $_SERVER['HTTP_HOST'];

        $generateURL = self::$requestProtocol
            . self::$requestHost
            . '/'
            . self::mainFolder;

        return $generateURL;
    }

    /**
     * Apply filter with redirect to page not found.
     *
     * @return false
     */
    private function validateURL($arrayRequest)
    {
        foreach ($this->arrayWords() as $words) {
            //Search keyword in string.
            $findText = strpos($this->convertString($arrayRequest), $words);

            if ($findText !== false) {
                header('Location: '
                    . $this->getUrl()
                    . '/pages/error-404.php');
                exit;
            }
        }

        return false;
    }

    /**
     * Validate whether the GET or POST request.
     *
     * @return false
     */
    public function validateRequest()
    {
        //Get url info.
        self::$requestData = $_REQUEST;
        self::$requestMethod = $_SERVER["REQUEST_METHOD"];
        self::$requestUrl = $_SERVER['REQUEST_URI'];

        if (self::$requestMethod == 'POST') {
            if (isset(self::$requestData) && is_array(self::$requestData))
                $this->validateURL(self::$requestData);
        } else if (self::$requestMethod == 'GET')
            $this->validateURL(self::$requestUrl);

        return false;
    }
}