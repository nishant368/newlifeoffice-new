<?php

/**
 * smartSeo class
 * --------------
 *
 * @author Andrei Dinca
 * @package smatSeo wordpress plugin
 * @version 1.0
 * @category seo, php, wordpress seo plugin
 * @contact andrei.webdeveloper@gmail.com
 *
 * Release Date: 28.02.2011
 */
class smartSeo {

    /**
     * Holds an insance of self
     * @var $instance
     */
    private static $instance = NULL;

    /**
     *
     * Return smartWattermark instance or create intitial instance
     *
     * @access public
     * @params $custom_option (optional)
     *
     * @return object
     *
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new smartSeo();
        }
        return self::$instance;
    }
    

    /**
     *
     * the constructor is set to private so
     * so nobody can create a new instance using new
     *
     */
    public function __construct() {
        
    }

    /**
     *
     * rule_keyword_in_string
     * @param $string = string
     * @param $keyword = string
     * @return boolen
     *
     */
    public function rule_keyword_in_string($string, $keyword) {
        return preg_match('/' . $keyword . '/i', $string);
    }
    
    /**
     *
     * rule_keyword_in_tag
     * @param $string = string
     * @param $keyword = string
     * @param $tag = string
     * @return boolen
     *
     */
    public function rule_keyword_in_tag($string, $keyword, $tag) {
        if ($string == "" || !class_exists('DOMDocument'))
            return false;
        $keyword = trim(strtolower($keyword));
        $keyword = $this->rule_esc($keyword);
        @$dom = new DOMDocument;
        @$dom->loadHTML(strtolower($string));
        $xPath = new DOMXPath($dom);
        switch ($tag) {
            case "img_alt": 
                return $xPath->evaluate('boolean(//img[contains(@alt, "' . $keyword . '")])');
                break;
            default: return $xPath->evaluate('boolean(/html/body//' . $tag . '[contains(.,"' . $keyword . '")])');
        }
    }
    
    function rule_esc($str, $quotation='"') {
        if ($quotation != '"' && $quotation != "'")
            return false;return str_replace($quotation, $quotation . $quotation, $str);
    }
    
    
    function count_occurences($string, $keyword, $case_sensitive = true) {
        if ($case_sensitive === false) {
            $string = strtolower($string);
            $keyword = strtolower($keyword);
        }
        
        return substr_count($string, $keyword);
    }
    
    function word_count($string) {
        $text = strip_tags($string);
        $word_count = explode(' ', $text);
        $word_count = count($word_count);
        return $word_count;
    }


    /**
     *
     * Like the constructor, we make __clone private
     * so nobody can clone the instance
     *
     */
    private function __clone() {
        
    }

}
