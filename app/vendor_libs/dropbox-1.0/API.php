<?php

/**
 * Dropbox API class 
 * 
 * @package Dropbox 
 * @copyright Copyright (C) 2010 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license http://code.google.com/p/dropbox-php/wiki/License MIT
 */
class Dropbox_API {

    /**
     * Sandbox root-path
     */
    const ROOT_SANDBOX = 'sandbox';

    /**
     * Dropbox root-path
     */
    const ROOT_DROPBOX = 'dropbox';

    /**
     * OAuth object 
     * 
     * @var Dropbox_OAuth
     */
    protected $oauth;
    
    /**
     * Default root-path, this will most likely be 'sandbox' or 'dropbox' 
     * 
     * @var string 
     */
    protected $root;

    /**
     * Constructor 
     * 
     * @param Dropbox_OAuth Dropbox_Auth object
     * @param string $root default root path (sandbox or dropbox) 
     */
    public function __construct(Dropbox_OAuth $oauth, $root = self::ROOT_DROPBOX) {

        $this->oauth = $oauth;
        $this->root = $root;

    }

    /**
     * Returns OAuth tokens based on an email address and passwords
     *
     * This can be used to bypass the regular oauth workflow.
     *
     * This method returns an array with 2 elements:
     *   * token
     *   * secret
     *
     * @param string $email 
     * @param string $password 
     * @return array 
     */
    public function getToken($email, $password) {

        $data = $this->oauth->fetch('http://api.dropbox.com/0/token', array(
            'email' => $email, 
            'password' => $password
        ),'POST');

        $data = json_decode($data['body']); 
        return array(
            'token' => $data->token,
            'token_secret' => $data->secret,
        );

    }

    /**
     * Returns information about the current dropbox account 
     * 
     * @return stdclass 
     */
    public function getAccountInfo() {

        $data = $this->oauth->fetch('http://api.dropbox.com/0/account/info');
        return json_decode($data['body'],true);

    }

    /**
     * Creates a new Dropbox account
     *
     * @param string $email 
     * @param string $first_name 
     * @param string $last_name 
     * @param string $password 
     * @return bool 
     */
    public function createAccount($email, $first_name, $last_name, $password) {

        $result = $this->oauth->fetch('http://api.dropbox.com/0/account',array(
            'email'      => $email,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'password'   => $password,
          ), 'POST');

        return $result['body']==='OK'; 

    }


    /**
     * Returns a file's contents 
     * 
     * @param string $path path 
     * @param string $root Use this to override the default root path (sandbox/dropbox) 
     * @return string 
     */
    public function getFile($path = '', $root = null) {

        if (is_null($root)) $root = $this->root;
        $path = implode("/", array_map('rawurlencode', explode("/", $path)));
        $result = $this->oauth->fetch('http://api-content.dropbox.com/0/files/' . $root . '/' . ltrim($path,'/'));
        return $result['body'];

    }

    /**
     * Uploads a new file
     *
     * @param string $path Target path (including filename) 
     * @param string $file Either a path to a file or a stream resource 
     * @param string $root Use this to override the default root path (sandbox/dropbox)  
     * @return bool 
     */
    public function putFile($path, $file, $root = null) {

        $directory = dirname($path);
        $filename = basename($path);

        if($directory==='.') $directory = '';
        if (is_null($root)) $root = $this->root;

        if (is_string($file)) {

            $file = fopen($file,'r');

        } elseif (!is_resource($file)) {
            throw new Dropbox_Exception('File must be a file-resource or a string');
        }
        $result=$this->multipartFetch('http://api-content.dropbox.com/0/files/' . 
                $root . '/' . trim($directory,'/'), $file, $filename);
        
        if(!isset($result["httpStatus"]) || $result["httpStatus"] != 200) 
            throw new Dropbox_Exception("Uploading file to Dropbox failed");

        return true;
    }


    /**
     * Copies a file or directory from one location to another 
     *
     * This method returns the file information of the newly created file.
     *
     * @param string $from source path 
     * @param string $to destination path 
     * @param string $root Use this to override the default root path (sandbox/dropbox)  
     * @return stdclass 
     */
    public function copy($from, $to, $root = null) {

        if (is_null($root)) $root = $this->root;
        $response = $this->oauth->fetch('http://api.dropbox.com/0/fileops/copy', array('from_path' => $from, 'to_path' => $to, 'root' => $root));

        return json_decode($response['body'],true);

    }

    /**
     * Creates a new folder 
     *
     * This method returns the information from the newly created directory
     *
     * @param string $path 
     * @param string $root Use this to override the default root path (sandbox/dropbox)  
     * @return stdclass 
     */
    public function createFolder($path, $root = null) {

        if (is_null($root)) $root = $this->root;

        // Making sure the path starts with a /
        $path = '/' . ltrim($path,'/');

        $response = $this->oauth->fetch('http://api.dropbox.com/0/fileops/create_folder', array('path' => $path, 'root' => $root),'POST');
        return json_decode($response['body'],true);

    }

    /**
     * Deletes a file or folder.
     *
     * This method will return the metadata information from the deleted file or folder, if successful.
     * 
     * @param string $path Path to new folder 
     * @param string $root Use this to override the default root path (sandbox/dropbox)  
     * @return array 
     */
    public function delete($path, $root = null) {

        if (is_null($root)) $root = $this->root;
        $response = $this->oauth->fetch('http://api.dropbox.com/0/fileops/delete', array('path' => $path, 'root' => $root));
        return json_decode($response['body']);

    }

    /**
     * Moves a file or directory to a new location 
     *
     * This method returns the information from the newly created directory
     *
     * @param mixed $from Source path 
     * @param mixed $to destination path
     * @param string $root Use this to override the default root path (sandbox/dropbox) 
     * @return stdclass 
     */
    public function move($from, $to, $root = null) {

        if (is_null($root)) $root = $this->root;
        $response = $this->oauth->fetch('http://api.dropbox.com/0/fileops/move', array('from_path' => rawurldecode($from), 'to_path' => rawurldecode($to), 'root' => $root));

        return json_decode($response['body'],true);

    }

    /**
     * Returns a list of links for a directory
     *
     * The links can be used to securely open files throug a browser. The links are cookie protected
     * so a user is asked to login if there's no valid session cookie.
     *
     * @param string $path Path to directory or file
     * @param string $root Use this to override the default root path (sandbox/dropbox)
     * @deprecated This method is no longer supported
     * @return array 
     */
    public function getLinks($path, $root = null) {

        throw new Dropbox_Exception('This API method is currently broken, and dropbox documentation about this is no longer online. Please ask Dropbox support if you really need this.');

        /*
        if (is_null($root)) $root = $this->root;
        
        $response = $this->oauth->fetch('http://api.dropbox.com/0/links/' . $root . '/' . ltrim($path,'/'));
        return json_decode($response,true);
        */ 

    }

    /**
     * Returns file and directory information
     * 
     * @param string $path Path to receive information from 
     * @param bool $list When set to true, this method returns information from all files in a directory. When set to false it will only return infromation from the specified directory.
     * @param string $hash If a hash is supplied, this method simply returns true if nothing has changed since the last request. Good for caching.
     * @param int $fileLimit Maximum number of file-information to receive 
     * @param string $root Use this to override the default root path (sandbox/dropbox) 
     * @return array|true 
     */
    public function getMetaData($path, $list = true, $hash = null, $fileLimit = null, $root = null) {

        if (is_null($root)) $root = $this->root;

        $args = array(
            'list' => $list,
        );

        if (!is_null($hash)) $args['hash'] = $hash; 
        if (!is_null($fileLimit)) $args['file_limit'] = $fileLimit; 

        $path = implode("/", array_map('rawurlencode', explode("/", $path)));
        $response = $this->oauth->fetch('http://api.dropbox.com/0/metadata/' . $root . '/' . ltrim($path,'/'), $args);

        /* 304 is not modified */
        if ($response['httpStatus']==304) {
            return true; 
        } else {
            return json_decode($response['body'],true);
        }

    } 

    /**
     * Returns a thumbnail (as a string) for a file path. 
     * 
     * @param string $path Path to file 
     * @param string $size small, medium or large 
     * @param string $root Use this to override the default root path (sandbox/dropbox)  
     * @return string 
     */
    public function getThumbnail($path, $size = 'small', $root = null) {

        if (is_null($root)) $root = $this->root;
        $response = $this->oauth->fetch('http://api-content.dropbox.com/0/thumbnails/' . $root . '/' . ltrim($path,'/'),array('size' => $size));

        return $response['body'];

    }

    /**
     * This method is used to generate multipart POST requests for file upload 
     * 
     * @param string $uri 
     * @param array $arguments 
     * @return bool 
     */
    protected function multipartFetch($uri, $file, $filename) {

        /* random string */
        $boundary = 'R50hrfBj5JYyfR3vF3wR96GPCC9Fd2q2pVMERvEaOE3D8LZTgLLbRpNwXek3';

        $headers = array(
            'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
        );

        $body="--" . $boundary . "\r\n";
        $body.="Content-Disposition: form-data; name=file; filename=".rawurldecode($filename)."\r\n";
        $body.="Content-type: application/octet-stream\r\n";
        $body.="\r\n";
        $body.=stream_get_contents($file);
        $body.="\r\n";
        $body.="--" . $boundary . "--";

        // Dropbox requires the filename to also be part of the regular arguments, so it becomes
        // part of the signature. 
        $uri.='?file=' . $filename;

        return $this->oauth->fetch($uri, $body, 'POST', $headers);

    }


}
