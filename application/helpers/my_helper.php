<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('getColours')){
   function getColours($darkMode = FALSE){
        // Adjust page colours for dark/light mode
        // style sheet stays the same just uses different classes
        // defined below and saved to variables for use in the views
        $bg = 'bg-light';
        $headerFooter = $bg;
        $mode = 'light';
        $menuText = 'Dark Mode';
        $textSecondary = 'text-muted';
        if ($darkMode) {
            $bg = 'text-light bg-dark';
            $mode = 'dark';
            $textPrimary = 'text-white';
            $textSecondary = 'text-light';
            $headerFooter = 'text-light bg-secondary';
            $menuText = 'Light Mode';
        }
        $data['bg'] = $bg;
        $data['mode'] = $mode;
        $data['textPrimary'] = $textPrimary;
        $data['textSecondary'] = $textSecondary;
        $data['headerFooter'] = $headerFooter;
        $data['menuText'] = $menuText;
        return $data;
    }
}